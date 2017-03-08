<?php

namespace Ds\Bundle\CommunicationBundle\Manager;

use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Bundle\CommunicationBundle\Collection\ChannelCollection;
use Ds\Bundle\TransportBundle\Collection\TransportCollection;
use Ds\Bundle\CommunicationBundle\Entity\Message;
use Ds\Bundle\TransportBundle\Entity\Profile;
use DateTime;

/**
 * Class MessageManager
 */
class MessageManager extends ApiEntityManager
{
    /**
     * @var \Ds\Bundle\CommunicationBundle\Collection\ChannelCollection
     */
    protected $channelCollection;

    /**
     * @var \Ds\Bundle\TransportBundle\Collection\TransportCollection
     */
    protected $transportCollection;

    /**
     * Constructor
     *
     * @param string $class
     * @param \Doctrine\Common\Persistence\ObjectManager $om
     * @param \Ds\Bundle\CommunicationBundle\Collection\ChannelCollection $channelCollection
     */
    public function __construct($class, ObjectManager $om, ChannelCollection $channelCollection, TransportCollection $transportCollection)
    {
        parent::__construct($class, $om);

        $this->channelCollection = $channelCollection;
        $this->transportCollection = $transportCollection;
    }

    /**
     * Send message
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Message $message
     * @param \Ds\Bundle\TransportBundle\Entity\Profile $profile
     * @return \Ds\Bundle\CommunicationBundle\Manager\MessageManager
     */
    public function send(Message $message, Profile $profile)
    {
        $message->setSentAt(new DateTime);
        $this->om->persist($message);
        $this->om->flush();

        $channel = $this->channelCollection->filter(function($item) use ($message) {
            return $item['implementation'] == $message->getChannel()->getImplementation();
        })->first()['channel'];

        $transport = $this->transportCollection->filter(function($item) use ($profile) {
            return $item['implementation'] == $profile->getTransport()->getImplementation();
        })->first()['transport'];

        $transport->setProfile($profile);
        $channel
            ->setTransport($transport)
            ->send($message);

        return $this;
    }
}
