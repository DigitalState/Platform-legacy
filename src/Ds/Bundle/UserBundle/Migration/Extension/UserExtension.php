<?php

namespace Ds\Bundle\UserBundle\Migration\Extension;

use Oro\Bundle\UserBundle\Entity\UserManager;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;
use RuntimeException;

/**
 * Class UserExtension
 */
class UserExtension
{
    /**
     * @var \Oro\Bundle\UserBundle\Entity\UserManager
     */
    protected $userManager;

    /**
     * Constructor
     *
     * @param \Oro\Bundle\UserBundle\Entity\UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * Import resource
     *
     * @param string $resource
     * @param \Doctrine\Common\Persistence\ObjectManager $objectManager
     */
    public function import($resource, ObjectManager $objectManager)
    {
        $data = Yaml::parse(file_get_contents($resource));

        foreach ($data['users'] as $item) {
            if (array_key_exists('prototype', $data)) {
                $item += $data['prototype'];
            }

            $user = $this->userManager->createUser();
            $user
                ->setUsername($item['username'])
                ->setPlainPassword($item['password'])
                ->setEmail($item['email'])
                ->setFirstName($item['first_name'])
                ->setLastName($item['last_name'])
                ->setEnabled($item['enabled']);

            foreach ($item['roles'] as $itemRole) {
                $role = $objectManager
                    ->getRepository('OroUserBundle:Role')
                    ->findOneBy([ 'role' => $itemRole ]);

                if (!$role) {
                    throw new RuntimeException('Role does not exist.');
                }

                $user->addRole($role);
            }

            $owner = $objectManager
                ->getRepository('OroOrganizationBundle:BusinessUnit')
                ->findOneBy([ 'name' => $item['owner'] ]);

            if (!$owner) {
                throw new RuntimeException('Business unit does not exist.');
            }

            $user->setOwner($owner);

            foreach ($item['business_units'] as $itemBusinessUnit) {
                $businessUnit = $objectManager
                    ->getRepository('OroOrganizationBundle:BusinessUnit')
                    ->findOneBy([ 'name' => $itemBusinessUnit ]);

                if (!$businessUnit) {
                    throw new RuntimeException('Business unit does not exist.');
                }

                $user->addBusinessUnit($businessUnit);
            }

            $organization = $objectManager
                ->getRepository('OroOrganizationBundle:Organization')
                ->findOneBy([ 'name' => $item['organization'] ]);

            if (!$organization) {
                throw new RuntimeException('Organization does not exist.');
            }

            $user->setOrganization($organization);

            foreach ($item['organizations'] as $itemOrganization) {
                $organization = $objectManager
                    ->getRepository('OroOrganizationBundle:Organization')
                    ->findOneBy([ 'name' => $itemOrganization ]);

                if (!$organization) {
                    throw new RuntimeException('Organization does not exist.');
                }

                $user->addOrganization($organization);
            }

            $this->userManager->updatePassword($user);
            $this->userManager->updateUser($user);
        }
    }
}
