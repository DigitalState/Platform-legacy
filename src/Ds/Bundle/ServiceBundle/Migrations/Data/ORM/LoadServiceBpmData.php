<?php

namespace Ds\Bundle\ServiceBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use Ds\Bundle\ServiceBundle\Migration\Extension\ServiceBpmExtensionAwareInterface;
use Ds\Bundle\ServiceBundle\Migration\Extension\ServiceBpmExtensionAwareTrait;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Doctrine\Common\Persistence\ObjectManager;



/**
 * Class LoadServiceData
 */
class LoadServiceBpmData extends AbstractFixture implements DependentFixtureInterface, ServiceBpmExtensionAwareInterface, ContainerAwareInterface
{
    use ServiceBpmExtensionAwareTrait;
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
        $this->setServiceBpmExtension($this->container->get('ds.service.bpm.migration.extension.service'));
        //
        $resource = __DIR__.'/../../../Resources/data/services_bpm.yml';
        $this->serviceBpmExtension->import($resource, $objectManager);
    }
}
