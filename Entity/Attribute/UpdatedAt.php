<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use DateTime;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Behavior;

/**
 * Trait UpdatedAt
 */
trait UpdatedAt
{
    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime")
     * @Behavior\Timestampable(on="update")
     */
    protected $updatedAt; # region accessors

    /**
     * Get updated at date
     *
     * @return \DateTime
     */
    public function getupdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return object
     */
    public function setUpdatedAt(DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    # endregion
}
