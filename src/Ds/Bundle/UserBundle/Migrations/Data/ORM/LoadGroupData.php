<?php

namespace Ds\Bundle\UserBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Ds\Bundle\UserBundle\Migration\Extension\GroupExtensionAwareInterface;
use Ds\Bundle\UserBundle\Migration\Extension\GroupExtensionAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadGroupData
 */
class LoadGroupData extends AbstractFixture implements DependentFixtureInterface, GroupExtensionAwareInterface, ContainerAwareInterface
{
    use GroupExtensionAwareTrait;
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
    public function load(ObjectManager $manager)
    {
        // @todo Remove once auto injection via GroupExtensionAwareInterface gets added.
        $this->setGroupExtension($this->container->get('ds.user.migration.extension.group'));
        //

        $resource = __DIR__.'/../../../Resources/data/groups.yml';
        $this->groupExtension->import($resource, $manager);
    }
}
