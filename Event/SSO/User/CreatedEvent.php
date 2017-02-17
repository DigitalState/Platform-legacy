<?php

namespace Ds\Bundle\SSOBundle\Event\SSO\User;

use Symfony\Component\EventDispatcher\Event;
use Oro\Bundle\UserBundle\Entity\User;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;

/**
 * Class CreatedEvent
 */
class CreatedEvent extends Event
{
    /**
     * @const string
     */
    const NAME = 'ds.event.sso.user.created';

    /**
     * @var \Oro\Bundle\UserBundle\Entity\User
     */
    protected $user; # region accessors

    /**
     * Get user
     *
     * @return \Oro\Bundle\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    # endregion

    /**
     * @var \HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface
     */
    protected $response; # region accessors

    /**
     * Get user response
     *
     * @return \HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    # endregion

    /**
     * Constructor
     *
     * @param \Oro\Bundle\UserBundle\Entity\User $user
     * @param \HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface $response
     */
    public function __construct(User $user, UserResponseInterface $response)
    {
        $this->user = $user;
        $this->response = $response;
    }
}
