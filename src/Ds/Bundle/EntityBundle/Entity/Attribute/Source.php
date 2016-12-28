<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait Source
 */
trait Source
{
    /**
     * @var string
     * @ORM\Column(name="source", type="string", length=255)
     * @Assert\NotBlank(message="ds.entity.source.not_blank")
     * @Assert\Length(min=1, max=255, minMessage="ds.entity.source.length.min", maxMessage="ds.entity.source.length.max")
     */
    protected $source; # region accessors

    /**
     * Set source
     *
     * @param string $source
     * @return object
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    # endregion
}
