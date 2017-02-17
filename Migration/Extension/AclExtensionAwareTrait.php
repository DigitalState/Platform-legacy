<?php

namespace Ds\Bundle\SecurityBundle\Migration\Extension;

/**
 * Trait AclExtensionAwareTrait
 */
trait AclExtensionAwareTrait
{
    /**
     * @var \Ds\Bundle\SecurityBundle\Migration\Extension\AclExtension
     */
    protected $aclExtension; # region accessors

    /**
     * Sets the acl extension
     *
     * @param \Ds\Bundle\SecurityBundle\Migration\Extension\AclExtension $aclExtension
     */
    public function setAclExtension(AclExtension $aclExtension)
    {
        $this->aclExtension = $aclExtension;
    }

    # endregion
}
