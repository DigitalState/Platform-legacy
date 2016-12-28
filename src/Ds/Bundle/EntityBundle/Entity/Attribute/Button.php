<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait Button
 */
trait Button
{
    /**
     * @var string
     * @ORM\Column(name="button", type="string", length=255)
     * @Assert\NotBlank(message="ds.entity.button.not_blank")
     * @Assert\Length(min=1, max=255, minMessage="ds.entity.button.length.min", maxMessage="ds.entity.button.length.max")
     */
    protected $button; # region accessors

    /**
     * Set button
     *
     * @param string $button
     * @return object
     */
    public function setButton($button)
    {
        $this->button = $button;

        return $this;
    }

    /**
     * Get button
     *
     * @return string
     */
    public function getButton()
    {
        return $this->button;
    }

    # endregion
}
