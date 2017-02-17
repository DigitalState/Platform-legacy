<?php

namespace Ds\Bundle\CommunicationBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\CommunicationBundle\Entity\Message;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class MessageController
 *
 * @Route("/communication/message")
 */
class MessageController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('communication_message');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.communication.message.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Message $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.communication.message.view")
     */
    public function viewAction(Message $entity)
    {
        return $this->handleView($entity);
    }

    /**
     * Create action
     *
     * @param string $alias
     * @return array
     * @Route("/create/{alias}", requirements={"alias":"[a-z]*"}, defaults={"alias":""})
     * @Template("DsCommunicationBundle:Message:edit.html.twig")
     * @AclAncestor("ds.communication.message.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Message $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.communication.message.edit")
     */
    public function editAction(Message $entity)
    {
        return $this->handleEdit($entity);
    }
}
