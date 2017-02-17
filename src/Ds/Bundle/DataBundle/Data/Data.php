<?php

namespace Ds\Bundle\DataBundle\Data;

use Ds\Bundle\DataBundle\Data\Resolver\Resolver;
use DomainException;

/**
 * Class Data
 */
class Data
{
    /**
     * @var array
     */
    protected $resolvers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->resolvers = [];
    }

    /**
     * Get value
     *
     * @param $variable
     * @return mixed
     * @throws \DomainException
     */
    public function get($variable)
    {
        foreach ($this->resolvers as $resolver) {
            if ($resolver->isMatch($variable)) {
                return $resolver->get($variable);
            }
        }

        throw new DomainException('Variable pattern is not valid.');
    }

    /**
     * Add resolver
     *
     * @param Resolver $resolver
     * @return \Ds\Bundle\DataBundle\Data\Data
     */
    public function addResolver(Resolver $resolver)
    {
        $this->resolvers[] = $resolver;

        return $this;
    }
}
