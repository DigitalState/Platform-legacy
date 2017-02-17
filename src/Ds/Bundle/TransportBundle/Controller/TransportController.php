<?php

namespace Ds\Bundle\TransportBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\TransportBundle\Entity\Transport;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class TransportController
 *
 * @Route("/transport")
 */
class TransportController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('transport');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.transport.transport.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\TransportBundle\Entity\Transport $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.transport.transport.view")
     */
    public function viewAction(Transport $entity)
    {
        return $this->handleView($entity);
    }

    /**
     * Create action
     *
     * @param string $alias
     * @return array
     * @Route("/create/{alias}", requirements={"alias":"[a-z]*"}, defaults={"alias":""})
     * @Template("DsTransportBundle:Transport:edit.html.twig")
     * @AclAncestor("ds.transport.transport.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\TransportBundle\Entity\Transport $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.transport.transport.edit")
     */
    public function editAction(Transport $entity)
    {
        return $this->handleEdit($entity);
    }
}
