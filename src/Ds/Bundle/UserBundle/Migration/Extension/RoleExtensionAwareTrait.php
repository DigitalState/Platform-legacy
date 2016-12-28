<?php

namespace Ds\Bundle\UserBundle\Migration\Extension;

/**
 * Trait RoleExtensionAwareTrait
 */
trait RoleExtensionAwareTrait
{
    /**
     * @var \Ds\Bundle\UserBundle\Migration\Extension\RoleExtension
     */
    protected $roleExtension; # region accessors

    /**
     * Sets the role extension
     *
     * @param \Ds\Bundle\UserBundle\Migration\Extension\RoleExtension $roleExtension
     */
    public function setRoleExtension(RoleExtension $roleExtension)
    {
        $this->roleExtension = $roleExtension;
    }

    # endregion
}
