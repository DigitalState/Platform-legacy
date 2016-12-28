<?php

namespace Ds\Bundle\CommunicationBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Ds\Bundle\SecurityBundle\Migration\Extension\AclExtensionAwareInterface;
use Ds\Bundle\SecurityBundle\Migration\Extension\AclExtensionAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadAclData
 */
class LoadAclData extends AbstractFixture implements DependentFixtureInterface, AclExtensionAwareInterface, ContainerAwareInterface
{
    use AclExtensionAwareTrait;
    use ContainerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'Ds\Bundle\CommunicationBundle\Migrations\Data\ORM\LoadRoleData'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $objectManager)
    {
        // @todo Remove once auto injection via AclExtensionAwareInterface gets added.
        $this->setAclExtension($this->container->get('ds.security.migration.extension.acl'));
        //

        $resource = __DIR__.'/../../../Resources/data/acl.yml';
        $this->aclExtension->import($resource, $objectManager);
    }
}
