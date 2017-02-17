<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use DateTime;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Behavior;

/**
 * Trait CreatedAt
 */
trait CreatedAt
{
    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime")
     * @Behavior\Timestampable(on="create")
     */
    protected $createdAt; # region accessors

    /**
     * Get created at date
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set created at date
     *
     * @param \DateTime $createdAt
     * @return object
     */
    public function setCreatedAt(DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    # endregion
}
