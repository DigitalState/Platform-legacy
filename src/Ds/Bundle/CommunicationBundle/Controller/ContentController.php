<?php

namespace Ds\Bundle\CommunicationBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\CommunicationBundle\Entity\Content;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class ContentController
 *
 * @Route("/communication/content")
 */
class ContentController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('communication_content');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.communication.content.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Content $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.communication.content.view")
     */
    public function viewAction(Content $entity)
    {
        return $this->handleView($entity);
    }

    /**
     * Create action
     *
     * @param string $alias
     * @return array
     * @Route("/create/{alias}", requirements={"alias":"[a-z]*"}, defaults={"alias":""})
     * @Template("DsCommunicationBundle:Content:edit.html.twig")
     * @AclAncestor("ds.communication.content.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Content $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.communication.content.edit")
     */
    public function editAction(Content $entity)
    {
        return $this->handleEdit($entity);
    }
}
