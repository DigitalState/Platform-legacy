<?php

namespace Ds\Bundle\AccountBpmBundle\Controller\Account;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\AbstractType;
use Craue\FormFlowBundle\Form\FormFlow;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class TaskController
 *
 * @Route("/task")
 */
class TaskController extends Controller
{
    /**
     * Index action
     *
     * @return array
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $bpm = $this->get('ds.bpm.bpm.api.factory')->create('camunda');
        $user = $this->getUser();
        $tasks = $bpm->getTasks([ 'assignee' => $user->getId() ]);
        $manager = $this->get('ds.case.manager.case');

        foreach ($tasks as $task) {
            $task->case = $manager->find((integer) $task->getDescription());
        }

        return [
            'tasks' => $tasks
        ];
    }

    /**
     * View action
     *
     * @param string $id
     * @return array
     * @Route("/{id}")
     * @Template()
     */
    public function formAction($id)
    {
        $bpm = $this->get('ds.bpm.bpm.api.factory')->create('camunda');
        $task = $bpm->getTask($id);
        $task->case = null;

        if (null !== $task->getDescription()) {
            $manager = $this->get('ds.case.manager.case');
            $task->case = $manager->find($task->getDescription());

            $resolver = $this->get('ds.bpm.data.resolver.bpm');
            $resolver->setCase($task->case);
        }

        $data = new \Ds\Bundle\BpmBundle\Entity\Data;

        $request = $this->get('request');
        $formKey = $task->formKey;

        if (!$formKey) {
            $formKey = 'ds:ds.bpm.form.bpm.type.empty';
        }

        list($provider, $form) = explode(':', $formKey, 2);
        $form = $this->get($form);
        $flow = null;
        $step = null;

        if ($form instanceof AbstractType) {
            $form = $this->createForm($form, $data);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                $variables = [ 'user_task_form_data' => $data ];
                $bpm->completeTask($id, $task->taskDefinitionKey, $variables);

                return $this->redirectToRoute('ds_accountbpm_account_task_index');
            }
        } else if ($form instanceof FormFlow) {
            $util = $this->get('craue_formflow_util');
            $flow = $form;
            $flow->bind($data);
            $form = $flow->createForm();
            $step = $this->generateUrl($request->attributes->get('_route'), $util->addRouteParameters(array_merge($request->query->all(), $request->attributes->get('_route_params')), $flow));

            if ($flow->isValid($form)) {
                $flow->saveCurrentStepData($form);

                if ($flow->nextStep()) {
                    if ($flow->redirectAfterSubmit($form)) {
                        $parameters = $util->addRouteParameters(array_merge($request->query->all(), $request->attributes->get('_route_params')), $flow);

                        return $this->redirect($this->generateUrl($request->attributes->get('_route'), $parameters));
                    } else {
                        $form = $flow->createForm();
                    }
                } else {
                    $data = $form->getData();
                    $variables = [ 'user_task_form_data' => $data ];
                    $bpm->completeTask($id, $task->taskDefinitionKey, $variables);
                    $flow->reset();

                    return $this->redirectToRoute('ds_accountbpm_account_task_index');
                }
            }
        }

        $service = null;

        if ($task->case) {
            $service = $task->case->getService();

            $manager = $this->get('ds.record.manager.record');
            $task->records = $manager->getList(null, null, [ 'case' => $task->case ]);
        }

        return [
            'service' => $service,
            'task' => $task,
            'flow' => $flow,
            'form' => $form->createView()
        ];
    }
}
