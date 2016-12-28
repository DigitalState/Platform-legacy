<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait Percentage
 */
trait Percentage
{
    /**
     * @var string
     * @ORM\Column(name="percentage", type="smallint")
     * @Assert\NotBlank(message="ds.entity.percentage.not_blank")
     * @Assert\Length(min=0, max=100, minMessage="ds.entity.percentage.length.min", maxMessage="ds.entity.percentage.length.max")
     */
    protected $percentage; # region accessors

    /**
     * Set percentage
     *
     * @param integer $percentage
     * @return object
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * Get percentage
     *
     * @return integer
     */
    public function getpercentage()
    {
        return $this->percentage;
    }

    # endregion
}
