<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait Description
 */
trait Description
{
    /**
     * @var string
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Assert\Length(max=2048, maxMessage="ds.entity.description.length.max")
     */
    protected $description; # region accessors

    /**
     * Set description
     *
     * @param string $description
     * @return object
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    # endregion
}
