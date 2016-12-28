<?php

namespace Ds\Bundle\AccountDashboardBundle\Controller\Account;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class DashboardController
 *
 * @Route("/dashboard")
 */
class DashboardController extends Controller
{
    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->getUser();

        $manager = $this->get('ds.case.manager.case');
        $cases = $manager->getList(3, 1, [ 'user' => $user ], [ 'createdAt' => 'DESC' ]);
        $caseCount = count($manager->getList(null, null, [ 'user' => $user ]));

        $manager = $this->get('ds.casestatus.manager.status');
        $statuses = [];

        foreach ($cases as $case) {
            $status = $manager->getList(1, 1, [ 'case' => $case ], [ 'createdAt' => 'DESC' ]);
            $statuses[$case->getId()] = array_shift($status);
        }

        $bpm = $this->get('ds.bpm.bpm.api.factory')->create('camunda');
        $taskCount = $bpm->getTaskCount([ 'assignee' => $user->getId() ]);

        $manager = $this->get('ds.service.manager.service');
        $services = $manager->getList(3, 1);

//        $manager = $this->get('ds.notification.manager.message');
//        $messages = $manager->getList(3, 1, [ 'user' => $user ], [ 'sentAt' => 'DESC' ]);

        return [
            'cases' => $cases,
            'caseCount' => $caseCount,
            'statuses' => $statuses,
            'taskCount' => $taskCount,
            'services' => $services,
//            'messages' => $messages
        ];
    }
}
