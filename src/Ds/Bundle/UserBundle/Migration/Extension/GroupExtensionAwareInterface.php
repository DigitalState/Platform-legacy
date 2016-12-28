<?php

namespace Ds\Bundle\UserBundle\Migration\Extension;

/**
 * Interface GroupExtensionAwareInterface
 */
interface GroupExtensionAwareInterface
{
    /**
     * Sets the group extension
     *
     * @param \Ds\Bundle\UserBundle\Migration\Extension\GroupExtension $groupExtension
     */
    public function setGroupExtension(GroupExtension $groupExtension);
}
