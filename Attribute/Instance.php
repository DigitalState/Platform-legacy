<?php

namespace Ds\Bundle\BpmBundle\Attribute;

/**
 * Trait Instance
 */
trait Instance
{
    /**
     * @var object
     */
    protected $instance; # region accessors

    /**
     * Set instance
     *
     * @param object $instance
     * @return object
     */
    public function setInstance($instance)
    {
        $this->instance = $instance;

        return $this;
    }

    /**
     * Get instance
     *
     * @return object
     */
    public function getInstance()
    {
        return $this->instance;
    }

    #endregion
}
