<?php

namespace Ds\Bundle\SSOTwitterBundle\Security\Core\User;

use Ds\Bundle\SSOBundle\Security\Core\User\AbstractOAuthUserProvider;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use LogicException;

/**
 * Class TwitterOAuthUserProvider
 */
class TwitterOAuthUserProvider extends AbstractOAuthUserProvider
{
    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        throw new LogicException('Implementation missing.');
    }
}
