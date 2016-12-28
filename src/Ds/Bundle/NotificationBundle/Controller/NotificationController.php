<?php

namespace Ds\Bundle\NotificationBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\NotificationBundle\Entity\Notification;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class NotificationController
 *
 * @Route("/notification")
 */
class NotificationController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('notification');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.notification.notification.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\NotificationBundle\Entity\Notification $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.notification.notification.view")
     */
    public function viewAction(Notification $entity)
    {
        return $this->handleView($entity);
    }

    /**
     * Create action
     *
     * @param string $alias
     * @return array
     * @Route("/create/{alias}", requirements={"alias":"[a-z]*"}, defaults={"alias":""})
     * @Template("DsNotificationBundle:Notification:edit.html.twig")
     * @AclAncestor("ds.notification.notification.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\NotificationBundle\Entity\Notification $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.notification.notification.edit")
     */
    public function editAction(Notification $entity)
    {
        return $this->handleEdit($entity);
    }
}
