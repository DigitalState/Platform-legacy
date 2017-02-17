<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait Icon
 */
trait Icon
{
    /**
     * @var string
     * @ORM\Column(name="icon", type="string", length=255)
     * @Assert\NotBlank(message="ds.entity.icon.not_blank")
     * @Assert\Length(min=1, max=255, minMessage="ds.entity.icon.length.min", maxMessage="ds.entity.icon.length.max")
     */
    protected $icon; # region accessors

    /**
     * Set icon
     *
     * @param string $icon
     * @return object
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    # endregion
}
