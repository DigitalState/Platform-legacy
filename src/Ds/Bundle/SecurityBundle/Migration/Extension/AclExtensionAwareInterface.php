<?php

namespace Ds\Bundle\SecurityBundle\Migration\Extension;

/**
 * Interface AclExtensionAwareInterface
 */
interface AclExtensionAwareInterface
{
    /**
     * Sets the acl extension
     *
     * @param \Ds\Bundle\SecurityBundle\Migration\Extension\AclExtension $aclExtension
     */
    public function setAclExtension(AclExtension $aclExtension);
}
