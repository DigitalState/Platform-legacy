<?php

namespace Ds\Bundle\UserPersonaBundle\Migration\Extension;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;
use Ds\Bundle\UserPersonaBundle\Entity\Definition;
use RuntimeException;

/**
 * Class DefinitionExtension
 */
class DefinitionExtension
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

        foreach ($data['definitions'] as $item) {
            if (array_key_exists('prototype', $data)) {
                $item += $data['prototype'];
            }

            $definition = new Definition;
            $definition
                ->setTitle($item['title'])
                ->setSlug($item['slug'])
                ->setData($item['data']);
            $owner = $objectManager
                ->getRepository('OroOrganizationBundle:BusinessUnit')
                ->findOneBy([ 'name' => $item['owner'] ]);

            if (!$owner) {
                throw new RuntimeException('Business unit does not exist.');
            }

            $definition->setOwner($owner);
            $organization = $objectManager
                ->getRepository('OroOrganizationBundle:Organization')
                ->findOneBy([ 'name' => $item['organization'] ]);

            if (!$organization) {
                throw new RuntimeException('Organization does not exist.');
            }

            $definition->setOrganization($organization);
            $objectManager->persist($definition);
            $objectManager->flush();
        }
    }
}
