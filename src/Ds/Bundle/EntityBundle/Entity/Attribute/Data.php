<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use OutOfRangeException;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait Data
 */
trait Data
{
    /**
     * @var array
     * @ORM\Column(name="data", type="json_array")
     */
    protected $data; # region accessors

    /**
     * Set data
     *
     * @param array $data
     * @return object
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @param string $property
     * @return array
     * @throws \OutOfRangeException
     */
    public function getData($property = null)
    {
        if (null === $property) {
            return $this->data;
        }

        if (!array_key_exists($property, $this->data)) {
            throw new OutOfRangeException('Array property does not exist.');
        }

        return $this->data[$property];
    }

    # endregion
}
