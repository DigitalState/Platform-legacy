<?php

namespace Ds\Bundle\CommunicationBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\CommunicationBundle\Entity\Channel;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class ChannelController
 *
 * @Route("/communication/channel")
 */
class ChannelController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('communication_channel');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.communication.channel.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Channel $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.communication.channel.view")
     */
    public function viewAction(Channel $entity)
    {
        return $this->handleView($entity);
    }

    /**
     * Create action
     *
     * @param string $alias
     * @return array
     * @Route("/create/{alias}", requirements={"alias":"[a-z]*"}, defaults={"alias":""})
     * @Template("DsCommunicationBundle:Channel:edit.html.twig")
     * @AclAncestor("ds.communication.channel.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Channel $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.communication.channel.edit")
     */
    public function editAction(Channel $entity)
    {
        return $this->handleEdit($entity);
    }
}
