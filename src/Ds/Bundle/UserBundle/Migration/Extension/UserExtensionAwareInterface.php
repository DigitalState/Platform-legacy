<?php

namespace Ds\Bundle\UserBundle\Migration\Extension;

/**
 * Interface UserExtensionAwareInterface
 */
interface UserExtensionAwareInterface
{
    /**
     * Sets the user extension
     *
     * @param \Ds\Bundle\UserBundle\Migration\Extension\UserExtension $userExtension
     */
    public function setUserExtension(UserExtension $userExtension);
}
