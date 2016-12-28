<?php

namespace Ds\Bundle\CaseBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\CaseBundle\Entity\CaseEntity;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class CaseController
 *
 * @Route("/case")
 */
class CaseController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('case');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.case.case.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\CaseBundle\Entity\CaseEntity $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.case.case.view")
     */
    public function viewAction(CaseEntity $entity)
    {
        return $this->handleView($entity);
    }

    /**
     * Create action
     *
     * @param string $alias
     * @return array
     * @Route("/create/{alias}", requirements={"alias":"[a-z]*"}, defaults={"alias":""})
     * @Template("DsCaseBundle:Case:edit.html.twig")
     * @AclAncestor("ds.case.case.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\CaseBundle\Entity\CaseEntity $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.case.case.edit")
     */
    public function editAction(CaseEntity $entity)
    {
        return $this->handleEdit($entity);
    }
}
