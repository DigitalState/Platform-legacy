<?php

namespace Ds\Bundle\UserBundle\Migration\Extension;

/**
 * Interface RoleExtensionAwareInterface
 */
interface RoleExtensionAwareInterface
{
    /**
     * Sets the role extension
     *
     * @param \Ds\Bundle\UserBundle\Migration\Extension\RoleExtension $roleExtension
     */
    public function setRoleExtension(RoleExtension $roleExtension);
}
