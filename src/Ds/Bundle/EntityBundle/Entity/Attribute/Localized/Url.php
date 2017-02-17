<?php

namespace Ds\Bundle\EntityBundle\Entity\Attribute\Localized;

use Doctrine\Common\Collections\ArrayCollection;
use Oro\Bundle\LocaleBundle\Entity\Localization;
use Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue;
use LogicException;

/**
 * Trait Url
 */
trait Url
{
    /**
     * Set urls
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $urls
     * @return object
     */
    public function setUrls(ArrayCollection $urls)
    {
        $this->urls = $urls;

        return $this;
    }

    /**
     * Get urls
     *
     * @return \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue[]
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * Add url
     *
     * @param \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue $url
     * @return object
     */
    public function addUrl(LocalizedFallbackValue $url)
    {
        if (!$this->urls->contains($url)) {
            $this->urls->add($url);
        }

        return $this;
    }

    /**
     * Remove url
     *
     * @param \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue $url
     * @return object
     */
    public function removeUrl(LocalizedFallbackValue $url)
    {
        if ($this->urls->contains($url)) {
            $this->urls->removeElement($url);
        }

        return $this;
    }

    /**
     * Get url
     *
     * @param \Oro\Bundle\LocaleBundle\Entity\Localization $localization
     * @return \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue
     */
    public function getUrl(Localization $localization = null)
    {
        return $this->getLocalizedFallbackValue($this->urls, $localization);
    }

    /**
     * Set default url
     *
     * @param string $url
     * @return object
     */
    public function setDefaultUrl($url)
    {
        $defaultUrl = $this->getDefaultUrl();

        if ($defaultUrl) {
            $this->removeUrl($defaultUrl);
        }

        $defaultUrl = new LocalizedFallbackValue;
        $defaultUrl->setString($url);
        $this->addUrl($defaultUrl);

        return $this;
    }

    /**
     * Get default url
     *
     * @return \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue
     * @throws \LogicException
     */
    public function getDefaultUrl()
    {
        return $this->getLocalizedFallbackValue($this->urls);
    }
}
