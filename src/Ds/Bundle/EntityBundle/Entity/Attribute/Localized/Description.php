<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute\Localized;

use Doctrine\Common\Collections\ArrayCollection;
use Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue;
use LogicException;

/**
 * Trait Description
 */
trait Description
{
    /**
     * Set descriptions
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $descriptions
     * @return object
     */
    public function setDescriptions(ArrayCollection $descriptions)
    {
        $this->descriptions = $descriptions;

        return $this;
    }

    /**
     * Get descriptions
     *
     * @return \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue[]
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }

    /**
     * Add description
     *
     * @param \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue $description
     * @return object
     */
    public function addDescription(LocalizedFallbackValue $description)
    {
        if (!$this->descriptions->contains($description)) {
            $this->descriptions->add($description);
        }

        return $this;
    }

    /**
     * Remove description
     *
     * @param \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue $description
     * @return object
     */
    public function removeDescription(LocalizedFallbackValue $description)
    {
        if ($this->descriptions->contains($description)) {
            $this->descriptions->removeElement($description);
        }

        return $this;
    }

    /**
     * Get default description
     *
     * @return \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue
     * @throws \LogicException
     */
    public function getDefaultDescription()
    {
        $descriptions = $this->descriptions->filter(function (LocalizedFallbackValue $description) {
            return null === $description->getLocalization();
        });

        if ($descriptions->count() > 1) {
            throw new LogicException('There must be only one default description.');
        }

        return $descriptions->first();
    }
}
