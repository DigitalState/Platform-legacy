<?php

namespace Ds\Bundle\NotificationBundle\Manager;

use Ds\Bundle\NotificationBundle\Entity\Notification;
use Ds\Bundle\CommunicationBundle\Entity\Communication;
use Ds\Bundle\CommunicationBundle\Entity\Content;
use Ds\Bundle\CommunicationBundle\Entity\Criterion;

/**
 * Class CommunicationManager
 */
class CommunicationManager
{
    /**
     * Create entity
     *
     * @param \Ds\Bundle\NotificationBundle\Entity\Notification $notification
     * @return \Ds\Bundle\CommunicationBundle\Entity\Communication
     */
    public function createEntity(Notification $notification)
    {
        $communication = new Communication;
        $communication->setTitle($notification->getTitle());
        $communication->setDescription($notification->getDescription());

        foreach ($notification->getChannels() as $channel) {
            $content = new Content;
            $content
                ->setCommunication($communication)
                ->setChannel($channel)
                ->setProfile(null)
                ->setTemplate(null)
                ->setTitle('')
                ->setPresentation('');
            $communication->addContent($content);
        }

        $criterion = new Criterion;
        $criterion
            ->setCommunication($communication)
            ->setImplementation('notification')
            ->setOperand1('id')
            ->setOperator('=')
            ->setOperand2($notification->getId());
        $communication->addCriterion($criterion);

        return $communication;
    }
}
