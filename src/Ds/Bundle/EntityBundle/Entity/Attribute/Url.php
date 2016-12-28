<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait Url
 */
trait Url
{
    /**
     * @var string
     * @ORM\Column(name="url", type="string", length=255)
     * @Assert\NotBlank(message="ds.entity.url.not_blank")
     * @Assert\Length(min=1, max=255, minMessage="ds.entity.url.length.min", maxMessage="ds.entity.url.length.max")
     */
    protected $url; # region accessors

    /**
     * Set url
     *
     * @param string $url
     * @return object
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    # endregion
}
