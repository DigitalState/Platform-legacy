<?php

namespace Ds\Bundle\SSOLinkedinBundle\Security\Core\User;

use Ds\Bundle\SSOBundle\Security\Core\User\AbstractOAuthUserProvider;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Ds\Bundle\SSOBundle\Event\SSO\User\CreatedEvent;
use Symfony\Component\Security\Core\Util\SecureRandom;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use RuntimeException;

/**
 * Class LinkedinOAuthUserProvider
 */
class LinkedinOAuthUserProvider extends AbstractOAuthUserProvider
{
    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        if (!$this->configManager->get('ds_sso_linkedin.enable_sso')) {
            throw new RuntimeException('Linkedin single sign-on is not enabled.');
        }

        $username = $response->getUsername();

        if (null === $username) {
            throw new BadCredentialsException('Linkedin single sign-on authentication failed.');
        }

        $resourceOwner = $response->getResourceOwner();
        $property = $resourceOwner->getName() . '_id';
        $user = $this->userManager->findUserBy([ $property => $username ]);

        if (!$user) {
            if (!$this->configManager->get('ds_sso_linkedin.create_user')) {
                throw new RuntimeException('Linkedin single sign-on user creation is not enabled.');
            }

            $storageManager = $this->userManager->getStorageManager();
            $repository = $storageManager->getRepository('OroUserBundle:Role');
            $role = $repository->findOneBy([ 'role' => 'ROLE_USER' ]);

            if (!$role) {
                throw new RuntimeException('Role does not exist.');
            }

            $repository = $storageManager->getRepository('OroOrganizationBundle:BusinessUnit');
            $owner = $repository->findOneBy([ 'name' => 'Main' ]);

            if (!$owner) {
                throw new RuntimeException('Business unit does not exist.');
            }

            $generator = new SecureRandom();

            $user = $this->userManager->createUser();
            $user
                ->setUsername($response->getEmail())
                ->setPlainPassword($generator->nextBytes(20))
                ->setEmail($response->getEmail())
                ->setFirstName($response->getFirstName())
                ->setLastName($response->getLastName())
                ->addRole($role)
                ->setOwner($owner)
                ->setOrganization($owner->getOrganization())
                ->addOrganization($owner->getOrganization())
                ->setEnabled(true)
                ->setLinkedinId($response->getUsername());
            $this->userManager->updatePassword($user);
            $this->userManager->updateUser($user);

            $event = new CreatedEvent($user, $response);
            $this->dispatcher->dispatch(CreatedEvent::NAME, $event);
        }

        if (!$user) {
            throw new RuntimeException('User does not exist.');
        }

        if (!$user->isEnabled()) {
            throw new RuntimeException('User is not enabled.');
        }

        return $user;
    }
}
