<?php

namespace Ds\Bundle\MessageBundle\Manager;

use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Bundle\TransportBundle\Collection\TransportCollection;
use Ds\Bundle\MessageBundle\Entity\Message;
use Ds\Bundle\TransportBundle\Entity\Profile;
use DateTime;

/**
 * Class MessageManager
 */
class MessageManager extends ApiEntityManager
{
    /**
     * @var \Ds\Bundle\TransportBundle\Collection\TransportCollection
     */
    protected $transportCollection;

    /**
     * Constructor
     *
     * @param string $class
     * @param \Doctrine\Common\Persistence\ObjectManager $om
     */
    public function __construct($class, ObjectManager $om, TransportCollection $transportCollection)
    {
        parent::__construct($class, $om);

        $this->transportCollection = $transportCollection;
    }

    /**
     * Send message
     *
     * @param \Ds\Bundle\MessageBundle\Entity\Message $message
     * @param \Ds\Bundle\TransportBundle\Entity\Profile $profile
     * @return \Ds\Bundle\MessageBundle\Manager\MessageManager
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
