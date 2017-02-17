<?php

namespace Ds\Bundle\NotificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ds\Bundle\NotificationBundle\Entity\Notification;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class CommunicationController
 *
 * @Route("/notification/communication")
 */
class CommunicationController extends Controller
{
    /**
     * Create action
     *
     * @param Notification $entity
     * @return array
     * @Route("/create/{id}", requirements={"id"="\d+"})
     * @AclAncestor("ds.communication.communication.create")
     */
    public function createAction(Notification $entity)
    {
        // @todo Make this work with entityConfig
        $manager = $this->get('ds.notification.manager.communication');
        $communication = $manager->createEntity($entity);
        $manager = $this->get('ds.communication.manager.communication');
        $om = $manager->getObjectManager();
        $om->persist($communication);
        $om->flush();

        return $this->redirectToRoute('ds_communication_communication_view', [ 'id' => $communication->getId() ]);
    }
}
