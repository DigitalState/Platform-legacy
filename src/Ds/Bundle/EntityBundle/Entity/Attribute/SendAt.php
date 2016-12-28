<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use DateTime;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait SendAt
 */
trait SendAt
{
    /**
     * @var \DateTime
     * @ORM\Column(name="send_at", type="datetime")
     */
    protected $sendAt; # region accessors

    /**
     * Get send at date
     *
     * @return \DateTime
     */
    public function getSendAt()
    {
        return $this->sendAt;
    }

    /**
     * Set send at date
     *
     * @param \DateTime $sendAt
     * @return object
     */
    public function setSendAt(DateTime $sendAt = null)
    {
        $this->sendAt = $sendAt;

        return $this;
    }

    # endregion
}
