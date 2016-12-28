<?php

namespace Ds\Bundle\UserBundle\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFunction;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Class UserExtension
 */
class UserExtension extends Twig_Extension
{
    /**
     * @var \Oro\Bundle\UserBundle\Entity\User
     */
    protected $user;

    /**
     * Constructor
     *
     * @param \Symfony\Component\Security\Core\SecurityContext $context
     */
    public function __construct(SecurityContext $context)
    {
        $token = $context->getToken();

        if ($token) {
            $this->user = $token->getUser();
        }
    }

    /**
     * Get functions
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('ds_user_full_name', [ $this, 'getFullName' ]),
            new Twig_SimpleFunction('ds_user_first_name', [ $this, 'getFirstName' ]),
            new Twig_SimpleFunction('ds_user_last_name', [ $this, 'getLastName' ])
        ];
    }

    /**
     * Get full name
     *
     * @return string
     */
    public function getFullName()
    {
        if ('anon.' === $this->user) {
            return 'Guest';
        } else {
            return $this->user->getFullName();
        }
    }

    /**
     * Get first name
     *
     * @return string
     */
    public function getFirstName()
    {
        if ('anon.' === $this->user) {
            return 'Guest';
        } else {
            return $this->user->getFirstName();
        }
    }

    /**
     * Get last name
     *
     * @return string
     */
    public function getLastName()
    {
        if ('anon.' === $this->user) {
            return 'Guest';
        } else {
            return $this->user->getLastName();
        }
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return 'ds_user_extension';
    }
}