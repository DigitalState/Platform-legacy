<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait Presentation
 */
trait Presentation
{
    /**
     * @var string
     * @ORM\Column(name="presentation", type="text", nullable=true)
     * @Assert\Length(max=65532, maxMessage="ds.entity.presentation.length.max")
     */
    protected $presentation; # region accessors

    /**
     * Set presentation
     *
     * @param string $presentation
     * @return object
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * Get presentation
     *
     * @return string
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    # endregion
}
