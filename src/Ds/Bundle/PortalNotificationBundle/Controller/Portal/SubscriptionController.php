<?php

namespace Ds\Bundle\PortalNotificationBundle\Controller\Portal;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class SubscriptionController
 *
 * @Route("/subscription")
 */
class SubscriptionController extends Controller
{
    /**
     * Edit action
     *
     * @Route("/{id}")
     * @Template()
     */
    public function editAction($id)
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

        $request = $this->get('request');
        $form = $this->createForm('ds_portalnotification_portal_subscription', $subscription, [
            'notification' => $notification
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subscription = $form->getData();
            $om = $manager->getObjectManager();
            $om->persist($subscription);
            $om->flush();
        }

        return new JsonResponse([
        ]);
    }
}
