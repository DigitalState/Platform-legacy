<?php

namespace Ds\Bundle\UserBundle\Migration\Extension;

/**
 * Trait GroupExtensionAwareTrait
 */
trait GroupExtensionAwareTrait
{
    /**
     * @var \Ds\Bundle\UserBundle\Migration\Extension\GroupExtension
     */
    protected $groupExtension; # region accessors

    /**
     * Sets the group extension
     *
     * @param \Ds\Bundle\UserBundle\Migration\Extension\GroupExtension $groupExtension
     */
    public function setGroupExtension(GroupExtension $groupExtension)
    {
        $this->groupExtension = $groupExtension;
    }

    # endregion
}
