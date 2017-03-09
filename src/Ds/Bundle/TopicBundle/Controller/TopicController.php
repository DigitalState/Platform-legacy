<?php

namespace Ds\Bundle\TopicBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\TopicBundle\Entity\Topic;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class TopicController
 *
 * @Route("/topic")
 */
class TopicController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('topic');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.topic.topic.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\TopicBundle\Entity\Topic $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.topic.topic.view")
     */
    public function viewAction(Topic $entity)
    {
        return $this->handleView($entity);
    }

    /**
     * Create action
     *
     * @param string $alias
     * @return array
     * @Route("/create/{alias}", requirements={"alias":"[a-z]*"}, defaults={"alias":""})
     * @Template("DsTopicBundle:Topic:edit.html.twig")
     * @AclAncestor("ds.topic.topic.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\TopicBundle\Entity\Topic $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.topic.topic.edit")
     */
    public function editAction(Topic $entity)
    {
        return $this->handleEdit($entity);
    }
}
