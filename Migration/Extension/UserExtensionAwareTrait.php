<?php

namespace Ds\Bundle\UserBundle\Migration\Extension;

/**
 * Trait UserExtensionAwareTrait
 */
trait UserExtensionAwareTrait
{
    /**
     * @var \Ds\Bundle\UserBundle\Migration\Extension\UserExtension
     */
    protected $userExtension; # region accessors

    /**
     * Sets the user extension
     *
     * @param \Ds\Bundle\UserBundle\Migration\Extension\UserExtension $userExtension
     */
    public function setUserExtension(UserExtension $userExtension)
    {
        $this->userExtension = $userExtension;
    }

    # endregion
}
