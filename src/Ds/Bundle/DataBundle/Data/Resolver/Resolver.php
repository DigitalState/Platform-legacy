<?php

namespace Ds\Bundle\DataBundle\Data\Resolver;

/**
 * Interface Resolver
 */
interface Resolver
{
    /**
     * Get pattern
     *
     * @return mixed
     */
    public function getPattern();

    /**
     * Check if variable pattern is a match
     *
     * @param string $variable
     * @return boolean
     */
    public function isMatch($variable);

    /**
     * Get variable
     *
     * @param string $variable
     * @return mixed
     */
    public function get($variable);
}
