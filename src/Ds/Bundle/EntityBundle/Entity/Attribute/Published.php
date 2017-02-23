<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait Published
 */
trait Published
{
    /**
     * @var string
     * @ORM\Column(name="published", type="boolean")
     */
    protected $published; # region accessors

    /**
     * Set published
     *
     * @param boolean $published
     * @return object
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    # endregion
}
