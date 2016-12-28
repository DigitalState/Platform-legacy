<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute\Localized;

use Doctrine\Common\Collections\ArrayCollection;
use Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue;
use LogicException;

/**
 * Trait Title
 */
trait Title
{
    /**
     * Set titles
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $titles
     * @return object
     */
    public function setTitles(ArrayCollection $titles)
    {
        $this->titles = $titles;

        return $this;
    }

    /**
     * Get titles
     *
     * @return \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue[]
     */
    public function getTitles()
    {
        return $this->titles;
    }

    /**
     * Add title
     *
     * @param \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue $title
     * @return object
     */
    public function addTitle(LocalizedFallbackValue $title)
    {
        if (!$this->titles->contains($title)) {
            $this->titles->add($title);
        }

        return $this;
    }

    /**
     * Remove title
     *
     * @param \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue $title
     * @return object
     */
    public function removeTitle(LocalizedFallbackValue $title)
    {
        if ($this->titles->contains($title)) {
            $this->titles->removeElement($title);
        }

        return $this;
    }

    /**
     * Get default title
     *
     * @return \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue
     * @throws \LogicException
     */
    public function getDefaultTitle()
    {
        $titles = $this->titles->filter(function (LocalizedFallbackValue $title) {
            return null === $title->getLocalization();
        });

        if ($titles->count() > 1) {
            throw new LogicException('There must be only one default title.');
        }

        return $titles->first();
    }
}
