<?php

namespace Ds\Bundle\ServiceBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\ServiceBundle\Entity\Activation;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class ActivationController
 *
 * @Route("/service/activation")
 */
class ActivationController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('activation');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.service.activation.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Activation $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.service.activation.view")
     */
    public function viewAction(Activation $entity)
    {
        return $this->handleView($entity);
    }

    /**
     * Create action
     *
     * @param string $alias
     * @return array
     * @Route("/create/{alias}", requirements={"alias":"[a-z]*"}, defaults={"alias":""})
     * @Template("DsServiceBundle:Activation:edit.html.twig")
     * @AclAncestor("ds.service.activation.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Activation $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.service.activation.edit")
     */
    public function editAction(Activation $entity)
    {
        return $this->handleEdit($entity);
    }
}
