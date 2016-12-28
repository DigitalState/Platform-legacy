<?php

namespace Ds\Bundle\BpmBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait BpmId
 */
trait BpmId
{
    /**
     * @var string
     * @ORM\Column(name="bpm_id", type="string", length=255)
     * @Assert\NotBlank(message="ds.bpm.bpm_id.not_blank")
     * @Assert\Length(min=1, max=255, minMessage="ds.bpm.bpm_id.length.min", maxMessage="ds.bpm.bpm_id.length.max")
     */
    protected $bpmId; # region accessors

    /**
     * Set bpm id
     *
     * @param string $bpmId
     * @return object
     */
    public function setBpmId($bpmId)
    {
        $this->bpmId = $bpmId;

        return $this;
    }

    /**
     * Get bpm id
     *
     * @return string
     */
    public function getBpmId()
    {
        return $this->bpmId;
    }

    # endregion
}
