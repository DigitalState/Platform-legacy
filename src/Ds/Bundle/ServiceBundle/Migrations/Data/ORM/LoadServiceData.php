<?php

namespace Ds\Bundle\ServiceBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use Ds\Bundle\ServiceBundle\Migration\Extension\ServiceExtensionAwareInterface;
use Ds\Bundle\ServiceBundle\Migration\Extension\ServiceExtensionAwareTrait;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Doctrine\Common\Persistence\ObjectManager;



/**
 * Class LoadServiceData
 */
class LoadServiceData extends AbstractFixture implements DependentFixtureInterface, ServiceExtensionAwareInterface, ContainerAwareInterface
{
    use ServiceExtensionAwareTrait;
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
        // @todo Remove once auto injection via GroupExtensionAwareInterface gets added.
        $this->setServiceExtension($this->container->get('ds.service.migration.extension.service'));
        //
        $resource = __DIR__.'/../../../Resources/data/services.yml';
        $this->serviceExtension->import($resource, $objectManager);
    }
}
