<?php

namespace Ds\Bundle\CommunicationBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Ds\Bundle\UserBundle\Migration\Extension\RoleExtensionAwareInterface;
use Ds\Bundle\UserBundle\Migration\Extension\RoleExtensionAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadRoleData
 */
class LoadRoleData extends AbstractFixture implements DependentFixtureInterface, RoleExtensionAwareInterface, ContainerAwareInterface
{
    use RoleExtensionAwareTrait;
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
        // @todo Remove once auto injection via RoleExtensionAwareInterface gets added.
        $this->setRoleExtension($this->container->get('ds.user.migration.extension.role'));
        //

        $resource = __DIR__.'/../../../Resources/data/roles.yml';
        $this->roleExtension->import($resource, $objectManager);
    }
}
