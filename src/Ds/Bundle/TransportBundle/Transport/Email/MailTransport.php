<?php

namespace Ds\Bundle\TransportBundle\Transport\Email;

use Ds\Bundle\TransportBundle\Transport\AbstractTransport;
use Ds\Bundle\TransportBundle\Model\Message;
use Ds\Bundle\TransportBundle\Entity\Profile;
use UnexpectedValueException;

/**
 * Class MailTransport
 */
class MailTransport extends AbstractTransport
{
    /**
     * {@inheritdoc}
     */
    public function send(Message $message, Profile $profile = null)
    {
        $profile = $profile ?: $this->profile;
        $message->setFrom($profile->getData('from'));
        $success = mail($message->getTo(), $message->getTitle(), $message->getContent(), 'From: ' . $message->getFrom());

        if (!$success) {
            //throw new UnexpectedValueException('Message could not be sent.');
        }

        return $this;
    }
}
