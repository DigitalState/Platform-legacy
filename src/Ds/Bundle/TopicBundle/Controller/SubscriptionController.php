<?php

namespace Ds\Bundle\TopicBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\TopicBundle\Entity\Subscription;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class SubscriptionController
 *
 * @Route("/topic/subscription")
 */
class SubscriptionController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('topic_subscription');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.topic.subscription.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\TopicBundle\Entity\Subscription $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.topic.subscription.view")
     */
    public function viewAction(Subscription $entity)
    {
        return $this->handleView($entity);
    }

    /**
     * Create action
     *
     * @param string $alias
     * @return array
     * @Route("/create/{alias}", requirements={"alias":"[a-z]*"}, defaults={"alias":""})
     * @Template("DsTopicBundle:Subscription:edit.html.twig")
     * @AclAncestor("ds.topic.subscription.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\TopicBundle\Entity\Subscription $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.topic.subscription.edit")
     */
    public function editAction(Subscription $entity)
    {
        return $this->handleEdit($entity);
    }
}