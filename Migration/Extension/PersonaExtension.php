<?php

namespace Ds\Bundle\UserPersonaBundle\Migration\Extension;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;
use Ds\Bundle\UserPersonaBundle\Entity\Persona;
use RuntimeException;

/**
 * Class PersonaExtension
 */
class PersonaExtension
{
    /**
     * Import data
     *
     * @param string $resource
     * @param \Doctrine\Common\Persistence\ObjectManager $objectManager
     * @throws \RuntimeException
     */
    public function importData($resource, ObjectManager $objectManager)
    {
        $data = Yaml::parse(file_get_contents($resource));

        foreach ($data['personas'] as $item) {
            if (array_key_exists('prototype', $data)) {
                $item += $data['prototype'];
            }

            $persona = new Persona;
            $persona->setData($item['data']);
            $definition = $objectManager
                ->getRepository('DsUserPersonaBundle:Definition')
                ->findOneBy([ 'slug' => $item['definition'] ]);

            if (!$definition) {
                throw new RuntimeException('Definition does not exist.');
            }

            $persona->setDefinition($definition);
            $user = $objectManager
                ->getRepository('OroUserBundle:User')
                ->findOneBy([ 'username' => $item['user'] ]);

            if (!$user) {
                throw new RuntimeException('User does not exist.');
            }

            $persona->setUser($user);
            $owner = $objectManager
                ->getRepository('OroOrganizationBundle:BusinessUnit')
                ->findOneBy([ 'name' => $item['owner'] ]);

            if (!$owner) {
                throw new RuntimeException('Business unit does not exist.');
            }

            $persona->setOwner($owner);
            $organization = $objectManager
                ->getRepository('OroOrganizationBundle:Organization')
                ->findOneBy([ 'name' => $item['organization'] ]);

            if (!$organization) {
                throw new RuntimeException('Organization does not exist.');
            }

            $persona->setOrganization($organization);
            $objectManager->persist($persona);
            $objectManager->flush();
        }
    }
}
