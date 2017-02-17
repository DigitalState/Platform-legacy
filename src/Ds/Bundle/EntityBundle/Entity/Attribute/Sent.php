<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait Sent
 */
trait Sent
{
    /**
     * @var string
     * @ORM\Column(name="sent", type="boolean")
     */
    protected $sent; # region accessors

    /**
     * Set sent
     *
     * @param boolean $sent
     * @return object
     */
    public function setSent($sent)
    {
        $this->sent = $sent;

        return $this;
    }

    /**
     * Get sent
     *
     * @return boolean
     */
    public function getSent()
    {
        return $this->sent;
    }

    # endregion
}
