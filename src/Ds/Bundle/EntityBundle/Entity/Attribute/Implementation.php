<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait Implementation
 */
trait Implementation
{
    /**
     * @var string
     * @ORM\Column(name="implementation", type="string", length=255)
     * @Assert\NotBlank(message="ds.entity.implementation.not_blank")
     * @Assert\Length(min=1, max=255, minMessage="ds.entity.implementation.length.min", maxMessage="ds.entity.implementation.length.max")
     */
    protected $implementation; # region accessors

    /**
     * Set implementation
     *
     * @param string $implementation
     * @return object
     */
    public function setImplementation($implementation)
    {
        $this->implementation = $implementation;

        return $this;
    }

    /**
     * Get implementation
     *
     * @return string
     */
    public function getImplementation()
    {
        return $this->implementation;
    }

    # endregion
}
