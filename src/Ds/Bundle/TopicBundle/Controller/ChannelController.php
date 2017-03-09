<?php

namespace Ds\Bundle\TopicBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\TopicBundle\Entity\Channel;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class ChannelController
 *
 * @Route("/topic/channel")
 */
class ChannelController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('topic_channel');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.topic.channel.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\TopicBundle\Entity\Channel $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.topic.channel.view")
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
     * @Template("DsTopicBundle:Channel:edit.html.twig")
     * @AclAncestor("ds.topic.channel.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\TopicBundle\Entity\Channel $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.topic.channel.edit")
     */
    public function editAction(Channel $entity)
    {
        return $this->handleEdit($entity);
    }
}
