<?php

namespace Ds\Bundle\CommunicationBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\CommunicationBundle\Entity\Criterion;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class CriterionController
 *
 * @Route("/communication/criterion")
 */
class CriterionController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('communication_criterion');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.communication.criterion.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Criterion $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.communication.criterion.view")
     */
    public function viewAction(Criterion $entity)
    {
        return $this->handleView($entity);
    }

    /**
     * Create action
     *
     * @param string $alias
     * @return array
     * @Route("/create/{alias}", requirements={"alias":"[a-z]*"}, defaults={"alias":""})
     * @Template("DsCommunicationBundle:Criterion:edit.html.twig")
     * @AclAncestor("ds.communication.criterion.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Criterion $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.communication.criterion.edit")
     */
    public function editAction(Criterion $entity)
    {
        return $this->handleEdit($entity);
    }
}
