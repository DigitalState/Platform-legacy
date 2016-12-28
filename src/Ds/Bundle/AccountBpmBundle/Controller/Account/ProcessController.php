<?php

namespace Ds\Bundle\AccountBpmBundle\Controller\Account;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\AbstractType;
use Craue\FormFlowBundle\Form\FormFlow;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class ProcessController
 *
 * @Route("/process")
 */
class ProcessController extends Controller
{
    /**
     * Start action
     *
     * @Route("/{id}/start")
     * @Template()
     */
    public function startAction($id)
    {
        $manager = $this->get('ds.service.manager.service');
        $service = $manager->find($id);

        $bpm = $this->get('ds.bpm.bpm.api.factory')->create($service->getBpm());

        $formKey = $bpm->getStartFormKey($service->getBpmId());

        $data = new \Ds\Bundle\BpmBundle\Entity\Data;

        $request = $this->get('request');

        if (!$formKey) {
            $formKey = 'ds:ds.bpm.form.bpm.type.empty';
        }

        list($provider, $form) = explode(':', $formKey, 2);
        $form = $this->get($form);
        $flow = null;
        $step = null;

        $user = $this->getUser();

        if ($form instanceof AbstractType) {
            $form = $this->createForm($form, $data);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                $variables = [
                    'none_start_event_form_data' => $data,
                    'user_id' => $user->getId(),
                    'user_business_unit_id' => $user->getOwner()->getId(),
                    'user_organization_id' => $user->getOrganization()->getId(),
                    'service_id' => $service->getId(),
                    'service_business_unit_id' => $service->getOwner()->getId(),
                    'service_organization_id' => $service->getOrganization()->getId()
                ];
                $bpm->startInstance($service->getBpmId(), $variables);

                return $this->redirectToRoute('ds_accountbpm_account_process_started', [ 'id' => $id ]);
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
                    $variables = [
                        'none_start_event_form_data' => $data,
                        'user_id' => $user->getId(),
                        'user_business_unit_id' => $user->getOwner()->getId(),
                        'user_organization_id' => $user->getOrganization()->getId(),
                        'service_id' => $service->getId(),
                        'service_business_unit_id' => $service->getOwner()->getId(),
                        'service_organization_id' => $service->getOrganization()->getId()
                    ];
                    $bpm->startInstance($service->getBpmId(), $variables);
                    $flow->reset();

                    return $this->redirectToRoute('ds_accountbpm_account_process_started', [ 'id' => $id ]);
                }
            }
        }

        return [
            'service' => $service,
            'flow' => $flow,
            'step' => $step,
            'form' => $form->createView(),
            'data' => $data
        ];
    }

    /**
     * Started action
     *
     * @Route("/{id}/started")
     * @Template()
     */
    public function startedAction($id)
    {
        $manager = $this->get('ds.service.manager.service');
        $service = $manager->find($id);

        return [
            'service' => $service
        ];
    }
}
