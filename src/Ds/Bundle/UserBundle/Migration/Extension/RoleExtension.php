<?php

namespace Ds\Bundle\UserBundle\Migration\Extension;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;
use Oro\Bundle\UserBundle\Entity\Role;

/**
 * Class RoleExtension
 */
class RoleExtension
{
    /**
     * Import resource
     *
     * @param string $resource
     * @param \Doctrine\Common\Persistence\ObjectManager $objectManager
     */
    public function import($resource, ObjectManager $objectManager)
    {
        $data = Yaml::parse(file_get_contents($resource));

        foreach ($data['roles'] as $item) {
            if (array_key_exists('prototype', $data)) {
                $item += $data['prototype'];
            }

            $role = new Role($item['role']);
            $role->setLabel($item['label']);
            $objectManager->persist($role);
            $objectManager->flush();
        }
    }
}
