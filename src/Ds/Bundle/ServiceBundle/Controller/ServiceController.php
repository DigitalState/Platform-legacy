<?php

namespace Ds\Bundle\ServiceBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\ServiceBundle\Entity\Service;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class ServiceController
 *
 * @Route("/service")
 */
class ServiceController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('service');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.service.service.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Service $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.service.service.view")
     */
    public function viewAction(Service $entity)
    {
        return $this->handleView($entity);
    }

    /**
     * Create action
     *
     * @param string $alias
     * @return array
     * @Route("/create/{alias}", requirements={"alias":"[a-z]*"}, defaults={"alias":""})
     * @Template("DsServiceBundle:Service:edit.html.twig")
     * @AclAncestor("ds.service.service.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Service $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.service.service.edit")
     */
    public function editAction(Service $entity)
    {
        return $this->handleEdit($entity);
    }
}
