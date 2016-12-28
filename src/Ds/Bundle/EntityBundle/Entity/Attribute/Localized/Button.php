<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute\Localized;

use Doctrine\Common\Collections\ArrayCollection;
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
     * Get default button
     *
     * @return \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue
     * @throws \LogicException
     */
    public function getDefaultButton()
    {
        $buttons = $this->buttons->filter(function (LocalizedFallbackValue $button) {
            return null === $button->getLocalization();
        });

        if ($buttons->count() > 1) {
            throw new LogicException('There must be only one default button.');
        }

        return $buttons->first();
    }
}
