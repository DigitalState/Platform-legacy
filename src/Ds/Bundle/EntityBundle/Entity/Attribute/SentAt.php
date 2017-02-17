<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait SentAt
 */
trait SentAt
{
    /**
     * @var \DateTime
     * @ORM\Column(name="sent_at", type="datetime", nullable=true)
     */
    protected $sentAt; # region accessors

    /**
     * Get sent at date
     *
     * @return \DateTime
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }

    /**
     * Set sent at date
     *
     * @param \DateTime $sentAt
     * @return object
     */
    public function setSentAt(\DateTime $sentAt = null)
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    # endregion
}
