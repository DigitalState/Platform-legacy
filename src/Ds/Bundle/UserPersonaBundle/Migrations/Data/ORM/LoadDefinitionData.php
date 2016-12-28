<?php

namespace Ds\Bundle\UserPersonaBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Ds\Bundle\UserPersonaBundle\Migration\Extension\DefinitionExtensionAwareInterface;
use Ds\Bundle\UserPersonaBundle\Migration\Extension\DefinitionExtensionAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadDefinitionData
 */
class LoadDefinitionData extends AbstractFixture implements DependentFixtureInterface, DefinitionExtensionAwareInterface, ContainerAwareInterface
{
    use DefinitionExtensionAwareTrait;
    use ContainerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'Oro\Bundle\OrganizationBundle\Migrations\Data\ORM\LoadOrganizationAndBusinessUnitData'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $objectManager)
    {
        // @todo Remove once auto injection via DefinitionExtensionAwareInterface gets added.
        $this->setDefinitionExtension($this->container->get('ds.userpersona.migration.extension.definition'));
        //

        $resource = __DIR__.'/../../../Resources/data/definitions.yml';
        $this->definitionExtension->import($resource, $objectManager);
    }
}
