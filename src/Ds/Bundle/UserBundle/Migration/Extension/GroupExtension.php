<?php

namespace Ds\Bundle\UserBundle\Migration\Extension;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;
use Oro\Bundle\UserBundle\Entity\Group;
use RuntimeException;

/**
 * Class GroupExtension
 */
class GroupExtension
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

        foreach ($data['groups'] as $item) {
            if (array_key_exists('prototype', $data)) {
                $item += $data['prototype'];
            }

            $group = new Group($item['name']);
            $owner = $objectManager
                ->getRepository('OroOrganizationBundle:BusinessUnit')
                ->findOneBy([ 'name' => $item['owner'] ]);

            if (!$owner) {
                throw new RuntimeException('Business unit does not exist.');
            }

            $group->setOwner($owner);
            $organization = $objectManager
                ->getRepository('OroOrganizationBundle:Organization')
                ->findOneBy([ 'name' => $item['organization'] ]);

            if (!$organization) {
                throw new RuntimeException('Organization does not exist.');
            }

            $group->setOrganization($organization);
            $objectManager->persist($group);
            $objectManager->flush();
        }
    }
}
