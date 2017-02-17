<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait Slug
 */
trait Slug
{
    /**
     * @var string
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     * @Assert\NotBlank(message="ds.entity.slug.not_blank")
     * @Assert\Length(min=1, max=255, minMessage="ds.entity.slug.length.min", maxMessage="ds.entity.slug.length.max")
     */
    protected $slug; # region accessors

    /**
     * Set slug
     *
     * @param string $slug
     * @return object
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    # endregion
}
