<?php

namespace Ds\Bundle\TransportBundle\Transport;

use Ds\Bundle\TransportBundle\Entity\Profile;

/**
 * Class AbstractTransport
 */
abstract class AbstractTransport implements Transport
{
    /**
     * @var \Ds\Bundle\TransportBundle\Entity\Profile
     */
    protected $profile; # region accessors


    /**
     * {@inheritdoc}
     */
    public function setProfile(Profile $profile)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getProfile()
    {
        return $this->profile;
    }

    # endregion
}
