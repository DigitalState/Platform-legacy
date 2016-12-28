<?php

namespace Ds\Bundle\PortalNotificationBundle\Controller\Portal;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class NotificationController
 *
 * @Route("/notification")
 */
class NotificationController extends Controller
{
    /**
     * Index action
     *
     * @Route("s")
     * @Template()
     */
    public function indexAction()
    {
        $manager = $this->get('ds.notification.manager.notification');
        $notifications = $manager->getList();

        return [
            'notifications' => $notifications
        ];
    }

    /**
     * View action
     *
     * @param integer $id
     * @return array
     * @Route("/{id}")
     * @Template()
     */
    public function viewAction($id)
    {
        $user = $this->getUser();

        $manager = $this->get('ds.notification.manager.notification');
        $notification = $manager->find($id);

        $manager = $this->get('ds.notification.manager.subscription');
        $subscription = $manager->getList(1, 1, [
            'user' => $user,
            'notification' => $notification
        ]);
        $subscription = array_shift($subscription);

        if (!$subscription) {
            $subscription = $manager->createEntity()
                ->setUser($user)
                ->setNotification($notification);
        }

        $form = $this->createForm('ds_portalnotification_portal_subscription', $subscription, [
            'notification' => $notification
        ]);

        return [
            'notification' => $notification,
            'subscription' => $subscription,
            'form' => $form->createView()
        ];
    }
}
