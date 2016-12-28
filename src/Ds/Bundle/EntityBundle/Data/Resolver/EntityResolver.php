<?php

namespace Ds\Bundle\EntityBundle\Data\Resolver;

use Ds\Bundle\DataBundle\Data\Resolver\Resolver;
use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;
use DomainException;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Class EntityResolver
 */
abstract class EntityResolver implements Resolver
{
    /**
     * @var string
     */
    protected $pattern;

    /**
     * @var \Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager
     */
    protected $manager;

    /**
     * Constructor
     *
     * @param \Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager $manager
     */
    public function __construct(ApiEntityManager $manager)
    {
        $this->manager = $manager;

        // @todo Make this regex bullet proof.
        $this->pattern = '/^ds\.' . strtolower(substr($manager->getClass(), strrpos($manager->getClass(), '\\') + 1)) . '\(([0-9]+|(,?\s?[a-zA-Z]+=([0-9]+|\"[^\"]*\"))*)\)/';
    }

    /**
     * {@inheritdoc}
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * {@inheritdoc}
     */
    public function isMatch($variable)
    {
        return preg_match($this->pattern, $variable);
    }

    /**
     * {@inheritdoc}
     */
    public function get($variable)
    {
        if (!preg_match($this->pattern, $variable, $matches)) {
            throw new DomainException('Variable pattern is not valid.');
        }

        $criteria = $matches[1];

        if (preg_match('/^[0-9]+$/', $criteria)) {
            $criteria = [
                'id' => $criteria
            ];
        } else {
            preg_match_all('/([^,=\s]+)=([0-9]+|\"[^,=\s]+\")/', $criteria, $result);
            $criteria = [];

            foreach ($result[2] as $key => $value) {
                if (preg_match('/^[0-9]+$/', $value)) {

                } else {
                    $value = substr($value, 1, -1);
                }

                $criteria[$result[1][$key]] = $value;
            }
        }

        $property = preg_replace($this->pattern, '', $variable);
        $list = $this->manager->getList(null, null, $criteria);

        if ('' !== $property) {
            $accessor = PropertyAccess::createPropertyAccessor();

            return $accessor->getValue($list, $property);
        } else {
            return $list;
        }
    }
}
