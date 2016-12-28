<?php

namespace Ds\Bundle\AccountCaseBundle\Controller\Account;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class CaseController
 *
 * @Route("/case")
 */
class CaseController extends Controller
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
        $cases = $manager->getList(10, 1, [ 'user' => $user ], [ 'createdAt' => 'DESC' ]);

        $manager = $this->get('ds.casestatus.manager.status');
        $statuses = [];

        foreach ($cases as $case) {
            $status = $manager->getList(1, 1, [ 'case' => $case ], [ 'createdAt' => 'DESC' ]);
            $statuses[$case->getId()] = array_shift($status);
        }

        return [
            'cases' => $cases,
            'statuses' => $statuses
        ];
    }

    /**
     * View action
     *
     * @param integer $id
     * @return array
     * @Route("/{id}")
     * @Template()
     */
    public function viewAction($id)
    {
        $manager = $this->get('ds.case.manager.case');
        $case = $manager->find($id);

        return [
            'case' => $case
        ];
    }
}
