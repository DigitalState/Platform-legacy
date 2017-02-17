<?php

namespace Ds\Bundle\BpmBundle\Attribute;

/**
 * Trait Variables
 */
trait Variables
{
    /**
     * @var array
     */
    protected $variables; # region accessors

    /**
     * Set variables
     *
     * @param array $variables
     * @return object
     */
    public function setVariables(array $variables = [])
    {
        $this->variables = $variables;

        return $this;
    }

    /**
     * Get variables
     *
     * @return array
     */
    public function getVariables()
    {
        return $this->variables;
    }

    #endregion
}
