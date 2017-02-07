<?php

namespace Ds\Bundle\CaseStatusBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\CaseStatusBundle\Entity\Status;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class StatusController
 *
 * @Route("/case/status")
 */
class StatusController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('case_status');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.casestatus.status.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\CaseStatusBundle\Entity\Status $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.casestatus.status.view")
     */
    public function viewAction(Status $entity)
    {
        return $this->handleView($entity);
    }

    /**
     * Create action
     *
     * @param string $alias
     * @return array
     * @Route("/create/{alias}", requirements={"alias":"[a-z]*"}, defaults={"alias":""})
     * @Template("DsCaseStatusBundle:Status:edit.html.twig")
     * @AclAncestor("ds.casestatus.status.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\CaseStatusBundle\Entity\Status $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.casestatus.status.edit")
     */
    public function editAction(Status $entity)
    {
        return $this->handleEdit($entity);
    }
}
