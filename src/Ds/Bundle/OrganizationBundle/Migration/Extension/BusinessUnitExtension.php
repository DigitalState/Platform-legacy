<?php

namespace Ds\Bundle\OrganizationBundle\Migration\Extension;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;
use Oro\Bundle\OrganizationBundle\Entity\BusinessUnit;
use RuntimeException;

/**
 * Class BusinessUnitExtension
 */
class BusinessUnitExtension
{
    /**
     * Import resource
     *
     * @param string $resource
     * @param \Doctrine\Common\Persistence\ObjectManager $objectManager
     * @throws \RuntimeException
     */
    public function import($resource, ObjectManager $objectManager)
    {
        $data = Yaml::parse(file_get_contents($resource));

        foreach ($data['business_units'] as $item) {
            if (array_key_exists('prototype', $data)) {
                $item += $data['prototype'];
            }

            $businessUnit = new BusinessUnit;
            $businessUnit
                ->setName($item['name'])
                ->setPhone($item['phone'])
                ->setWebsite($item['website'])
                ->setEmail($item['email'])
                ->setFax($item['fax']);

            if (array_key_exists('parent', $item) && $item['parent']) {
                $parent = $objectManager
                    ->getRepository('OroOrganizationBundle:BusinessUnit')
                    ->findOneBy([ 'name' => $item['parent'] ]);

                if (!$parent) {
                    throw new RuntimeException('Business unit does not exist.');
                }

                $businessUnit->setParentBusinessUnit($parent);
            }

            $organization = $objectManager
                ->getRepository('OroOrganizationBundle:Organization')
                ->findOneBy([ 'name' => $item['organization'] ]);

            if (!$organization) {
                throw new RuntimeException('Organization does not exist.');
            }

            $businessUnit->setOrganization($organization);
            $objectManager->persist($businessUnit);
            $objectManager->flush();
        }
    }
}
