<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute\Localized;

use Doctrine\Common\Collections\ArrayCollection;
use Oro\Bundle\LocaleBundle\Entity\Localization;
use Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue;
use LogicException;

/**
 * Trait Presentation
 */
trait Presentation
{
    /**
     * Set presentations
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $presentations
     * @return object
     */
    public function setPresentations(ArrayCollection $presentations)
    {
        $this->presentations = $presentations;

        return $this;
    }

    /**
     * Get presentations
     *
     * @return \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue[]
     */
    public function getPresentations()
    {
        return $this->presentations;
    }

    /**
     * Add presentation
     *
     * @param \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue $presentation
     * @return object
     */
    public function addPresentation(LocalizedFallbackValue $presentation)
    {
        if (!$this->presentations->contains($presentation)) {
            $this->presentations->add($presentation);
        }

        return $this;
    }

    /**
     * Remove presentation
     *
     * @param \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue $presentation
     * @return object
     */
    public function removePresentation(LocalizedFallbackValue $presentation)
    {
        if ($this->presentations->contains($presentation)) {
            $this->presentations->removeElement($presentation);
        }

        return $this;
    }

    /**
     * Get presentation
     *
     * @param \Oro\Bundle\LocaleBundle\Entity\Localization $localization
     * @return \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue
     */
    public function getPresentation(Localization $localization = null)
    {
        return $this->getLocalizedFallbackValue($this->presentations, $localization);
    }

    /**
     * Set default presentation
     *
     * @param string $presentation
     * @return object
     */
    public function setDefaultPresentation($presentation)
    {
        $defaultPresentation = $this->getDefaultPresentation();

        if ($defaultPresentation) {
            $this->removePresentation($defaultPresentation);
        }

        $defaultPresentation = new LocalizedFallbackValue;
        $defaultPresentation->setString($presentation);
        $this->addPresentation($defaultPresentation);

        return $this;
    }

    /**
     * Get default presentation
     *
     * @return \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue
     * @throws \LogicException
     */
    public function getDefaultPresentation()
    {
        return $this->getLocalizedFallbackValue($this->presentations);
    }
}
