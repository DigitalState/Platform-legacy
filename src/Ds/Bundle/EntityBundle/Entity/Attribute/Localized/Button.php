<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute\Localized;

use Doctrine\Common\Collections\ArrayCollection;
use Oro\Bundle\LocaleBundle\Entity\Localization;
use Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue;
use LogicException;

/**
 * Trait Button
 */
trait Button
{
    /**
     * Set buttons
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $buttons
     * @return object
     */
    public function setButtons(ArrayCollection $buttons)
    {
        $this->buttons = $buttons;

        return $this;
    }

    /**
     * Get buttons
     *
     * @return \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue[]
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * Add button
     *
     * @param \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue $button
     * @return object
     */
    public function addButton(LocalizedFallbackValue $button)
    {
        if (!$this->buttons->contains($button)) {
            $this->buttons->add($button);
        }

        return $this;
    }

    /**
     * Remove button
     *
     * @param \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue $button
     * @return object
     */
    public function removeButton(LocalizedFallbackValue $button)
    {
        if ($this->buttons->contains($button)) {
            $this->buttons->removeElement($button);
        }

        return $this;
    }

    /**
     * Get button
     *
     * @param \Oro\Bundle\LocaleBundle\Entity\Localization $localization
     * @return \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue
     */
    public function getButton(Localization $localization = null)
    {
        return $this->getLocalizedFallbackValue($this->buttons, $localization);
    }

    /**
     * Set default button
     *
     * @param string $button
     * @return object
     */
    public function setDefaultButton($button)
    {
        $defaultButton = $this->getDefaultButton();

        if ($defaultButton) {
            $this->removeButton($defaultButton);
        }

        $defaultButton = new LocalizedFallbackValue;
        $defaultButton->setString($button);
        $this->addButton($defaultButton);

        return $this;
    }

    /**
     * Get default button
     *
     * @return \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue
     * @throws \LogicException
     */
    public function getDefaultButton()
    {
        return $this->getLocalizedFallbackValue($this->buttons);
    }
}
