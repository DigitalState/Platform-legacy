<?php

namespace Ds\Bundle\OrganizationBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Ds\Bundle\OrganizationBundle\Migration\Extension\BusinessUnitExtensionAwareInterface;
use Ds\Bundle\OrganizationBundle\Migration\Extension\BusinessUnitExtensionAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadBusinessUnitData
 */
class LoadBusinessUnitData extends AbstractFixture implements DependentFixtureInterface, BusinessUnitExtensionAwareInterface, ContainerAwareInterface
{
    use BusinessUnitExtensionAwareTrait;
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
        // @todo Remove once auto injection via BusinessUnitExtensionAwareInterface gets added.
        $this->setBusinessUnitExtension($this->container->get('ds.organization.migration.extension.business_unit'));
        //

        $resource = __DIR__.'/../../../Resources/data/business_units.yml';
        $this->businessUnitExtension->import($resource, $objectManager);
    }
}
