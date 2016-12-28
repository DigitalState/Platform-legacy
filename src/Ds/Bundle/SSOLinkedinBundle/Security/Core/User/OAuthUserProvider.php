<?php

namespace Ds\Bundle\SSOLinkedinBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use Oro\Bundle\ConfigBundle\Config\ConfigManager;
use Oro\Bundle\UserBundle\Entity\UserManager;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Exception;

/**
 * Class OAuthUserProvider
 */
class OAuthUserProvider implements OAuthAwareUserProviderInterface
{
    /**
     * @var \Oro\Bundle\UserBundle\Entity\UserManager
     */
    protected $userManager;

    /**
     * @var \Oro\Bundle\ConfigBundle\Config\ConfigManager
     */
    protected $configManager;

    /**
     * Constructor
     *
     * @param \Oro\Bundle\UserBundle\Entity\UserManager   $userManager
     * @param \Oro\Bundle\ConfigBundle\Config\ConfigManager $configManager
     */
    public function __construct(UserManager $userManager, ConfigManager $configManager)
    {
        $this->userManager = $userManager;
        $this->configManager = $configManager;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        if (!$this->configManager->get('ds_sso_linkedin.enable_sso')) {
            throw new Exception('SSO is not enabled');
        }

        $username = $response->getUsername();

        if (null === $username) {
            throw new BadCredentialsException('Bad credentials.');
        }

        $property = $response->getResourceOwner()->getName() . '_id';
        $user = $this->userManager->findUserBy([ $property => $username ]);

        if (!$user) {
            $user = $this->userManager->findUserByEmail($response->getEmail());

            if ($user) {
                $user->setLinkedinId($username);
                $this->userManager->updateUser($user);
            }
        }

        if (!$user || !$user->isEnabled()) {
            throw new BadCredentialsException('Bad credentials.');
        }

        return $user;
    }
}
