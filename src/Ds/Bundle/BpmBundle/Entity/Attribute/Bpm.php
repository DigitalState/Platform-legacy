<?php

namespace Ds\Bundle\BpmBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait Bpm
 */
trait Bpm
{
    /**
     * @var string
     * @ORM\Column(name="bpm", type="string", length=255)
     * @Assert\NotBlank(message="ds.bpm.bpm.not_blank")
     * @Assert\Length(min=1, max=255, minMessage="ds.bpm.bpm.length.min", maxMessage="ds.bpm.bpm.length.max")
     */
    protected $bpm; # region accessors

    /**
     * Set bpm
     *
     * @param string $bpm
     * @return object
     */
    public function setBpm($bpm)
    {
        $this->bpm = $bpm;

        return $this;
    }

    /**
     * Get bpm
     *
     * @return string
     */
    public function getBpm()
    {
        return $this->bpm;
    }

    # endregion
}
