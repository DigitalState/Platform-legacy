<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute\Localized;

use Doctrine\Common\Collections\ArrayCollection;
use Oro\Bundle\LocaleBundle\Entity\Localization;
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
     * Get description
     *
     * @param \Oro\Bundle\LocaleBundle\Entity\Localization $localization
     * @return \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue
     */
    public function getDescription(Localization $localization = null)
    {
        return $this->getLocalizedFallbackValue($this->descriptions, $localization);
    }

    /**
     * Set default description
     *
     * @param string $description
     * @return object
     */
    public function setDefaultDescription($description)
    {
        $defaultDescription = $this->getDefaultDescription();

        if ($defaultDescription) {
            $this->removeDescription($defaultDescription);
        }

        $defaultDescription = new LocalizedFallbackValue;
        $defaultDescription->setString($description);
        $this->addDescription($defaultDescription);

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
        return $this->getLocalizedFallbackValue($this->descriptions);
    }
}
