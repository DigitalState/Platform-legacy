<?php

namespace Ds\Bundle\LocaleBundle\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFilter;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class LocaleExtension
 */
class LocaleExtension extends Twig_Extension
{
    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    protected $request;

    /**
     * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
     */
    public function setRequest(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * Get filters
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('localized_value', [ $this, 'getLocalizedValue' ])
        ];
    }

    /**
     * Get localized value.
     *
     * @return string
     */
    public function getLocalizedValue($values)
    {
        $localizedValue = null;
        $locale = $this->request->getLocale();

        foreach ($values as $value) {
            if ($value->getLocalization() && $value->getLocalization()->getLanguageCode() == $locale) {
                $localizedValue = $value->getText();
            }
        }

        if (null === $localizedValue) {
            foreach ($values as $value) {
                if (null === $value->getLocalization()) {
                    $localizedValue = $value->getText();
                }
            }
        }

        return $localizedValue;
    }

    public function getName()
    {
        return 'ds_locale_locale_extension';
    }
}
