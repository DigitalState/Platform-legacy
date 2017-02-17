<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait Id
 */
trait Id
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id; #region accessors

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    # endregion
}
