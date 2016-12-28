<?php

namespace Ds\Bundle\AssetBundle\Model;

/**
 * Class ExtendAsset
 */
class ExtendAsset
{
    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Checks if this entity can be associated with the given target entity
     *
     * @param string $targetClass
     * @return boolean
     */
    public function supportTarget($targetClass)
    {
        return false;
    }

    /**
     * Gets the entity this note is associated with
     *
     * @return object|null
     */
    public function getTarget()
    {
        return null;
    }

    /**
     * Sets the entity this entity is associated with
     *
     * @param object $target
     * @return \Ds\Bundle\AssetBundle\Model\ExtendAsset
     */
    public function setTarget($target)
    {
        return $this;
    }
}
