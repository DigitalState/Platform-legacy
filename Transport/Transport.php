<?php

namespace Ds\Bundle\TransportBundle\Transport;

use Ds\Bundle\TransportBundle\Model\Message;
use Ds\Bundle\TransportBundle\Entity\Profile;

/**
 * Interface Transport
 */
interface Transport
{
    /**
     * Set profile
     *
     * @param \Ds\Bundle\TransportBundle\Entity\Profile $profile
     * @return \Ds\Bundle\TransportBundle\Transport\Transport
     */
    public function setProfile(Profile $profile);

    /**
     * Get profile
     *
     * @return \Ds\Bundle\TransportBundle\Entity\Profile
     */
    public function getProfile();

    /**
     * Send a message
     *
     * @param \Ds\Bundle\TransportBundle\Model\Message $message
     * @param \Ds\Bundle\TransportBundle\Entity\Profile $profile
     * @return \Ds\Bundle\TransportBundle\Transport\Transport
     * @throws \LogicException
     * @throws \UnexpectedValueException
     */
    public function send(Message $message, Profile $profile = null);
}
