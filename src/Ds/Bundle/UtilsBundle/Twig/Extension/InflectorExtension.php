<?php

namespace Ds\Bundle\UtilsBundle\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFilter;

/**
 * Class InflectorExtension
 */
class InflectorExtension extends Twig_Extension
{
    /**
     * Get filters
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('inflect', [ $this, 'inflect' ])
        ];
    }

    /**
     * Inflect string
     *
     * @param $string
     * @return string
     */
    public function inflect($string)
    {
        return ucfirst(preg_replace('/(.*?[a-z]{1})([A-Z]{1}.*?)/', '${1} ${2}', $string));
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return 'ds_inflector_extension';
    }
}