<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait Type
 */
trait Type
{
    /**
     * @var string
     * @ORM\Column(name="type", type="string", length=255)
     * @Assert\NotBlank(message="ds.entity.type.not_blank")
     * @Assert\Length(min=1, max=255, minMessage="ds.entity.type.length.min", maxMessage="ds.entity.type.length.max")
     */
    protected $type; # region accessors

    /**
     * Set type
     *
     * @param string $type
     * @return object
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    # endregion
}
