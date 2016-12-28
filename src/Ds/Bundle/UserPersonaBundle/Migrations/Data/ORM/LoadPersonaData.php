<?php

namespace Ds\Bundle\UserPersonaBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Ds\Bundle\UserPersonaBundle\Migration\Extension\PersonaExtensionAwareInterface;
use Ds\Bundle\UserPersonaBundle\Migration\Extension\PersonaExtensionAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadPersonaData
 */
class LoadPersonaData extends AbstractFixture implements DependentFixtureInterface, PersonaExtensionAwareInterface, ContainerAwareInterface
{
    use PersonaExtensionAwareTrait;
    use ContainerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'Oro\Bundle\OrganizationBundle\Migrations\Data\ORM\LoadOrganizationAndBusinessUnitData',
            'Ds\Bundle\UserPersonaBundle\Migrations\Data\ORM\LoadDefinitionData'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $objectManager)
    {
        // @todo Remove once auto injection via PersonaExtensionAwareInterface gets added.
        $this->setPersonaExtension($this->container->get('ds.userpersona.migration.extension.persona'));
        //

        $resource = __DIR__.'/../../../Resources/data/personas.yml';
        $this->personaExtension->importData($resource, $objectManager);
    }
}
