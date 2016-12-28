<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait Enabled
 */
trait Enabled
{
    /**
     * @var string
     * @ORM\Column(name="enabled", type="boolean")
     */
    protected $enabled; # region accessors

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return object
     */
    public function setSent($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    # endregion
}
