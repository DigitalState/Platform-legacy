<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait Status
 */
trait Status
{
    /**
     * @var string
     * @ORM\Column(name="status", type="string", length=255)
     * @Assert\NotBlank(message="ds.entity.status.not_blank")
     * @Assert\Length(min=1, max=255, minMessage="ds.entity.status.length.min", maxMessage="ds.entity.status.length.max")
     */
    protected $status; # region accessors

    /**
     * Set status
     *
     * @param string $status
     * @return object
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    # endregion
}
