<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait State
 */
trait State
{
    /**
     * @var string
     * @ORM\Column(name="state", type="string", length=255)
     * @Assert\NotBlank(message="ds.entity.state.not_blank")
     * @Assert\Length(min=1, max=255, minMessage="ds.entity.state.length.min", maxMessage="ds.entity.state.length.max")
     */
    protected $state; # region accessors

    /**
     * Set state
     *
     * @param string $state
     * @return object
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    # endregion
}
