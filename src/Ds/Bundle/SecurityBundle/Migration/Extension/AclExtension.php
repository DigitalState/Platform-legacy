<?php

namespace Ds\Bundle\SecurityBundle\Migration\Extension;

use Doctrine\Common\Persistence\ObjectManager;
use Oro\Bundle\SecurityBundle\Acl\Persistence\AclManager;
use Symfony\Component\Yaml\Yaml;
use RuntimeException;

/**
 * Class AclExtension
 */
class AclExtension
{
    /**
     * @var \Oro\Bundle\SecurityBundle\Acl\Persistence\AclManager
     */
    protected $aclManager;

    /**
     * @param \Oro\Bundle\SecurityBundle\Acl\Persistence\AclManager $aclManager
     */
    public function __construct(AclManager $aclManager)
    {
        $this->aclManager = $aclManager;
    }

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

        foreach ($data['acl'] as $role => $acl) {
            $role = $objectManager
                ->getRepository('OroUserBundle:Role')
                ->findOneBy([ 'role' => $role ]);

            if (!$role) {
                throw new RuntimeException('Role does not exist.');
            }

            foreach ($acl as $item => $permissions) {
                $sid = $this->aclManager->getSid($role->getRole());
                $oid = $this->aclManager->getOid($item);
                $extension = $this->aclManager->getExtensionSelector()->select($oid);
                $maskBuilders = $extension->getAllMaskBuilders();

                foreach ($maskBuilders as $maskBuilder) {
                    $mask = $maskBuilder->reset()->get();

                    foreach ($permissions as $permission) {
                        if ($maskBuilder->hasMask('MASK_'.$permission)) {
                            $mask = $maskBuilder->add($permission)->get();
                        }
                    }

                    $this->aclManager->setPermission($sid, $oid, $mask);
                }

                $this->aclManager->flush();
            }
        }
    }
}
