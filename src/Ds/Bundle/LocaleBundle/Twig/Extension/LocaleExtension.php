<?php

namespace Ds\Bundle\LocaleBundle\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFilter;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\Common\Collections\ArrayCollection;
use Oro\Bundle\LocaleBundle\Entity\FallbackTrait;
use Oro\Bundle\LocaleBundle\Entity\Repository\LocalizationRepository;
use RuntimeException;

/**
 * Class LocaleExtension
 */
class LocaleExtension extends Twig_Extension
{
    use FallbackTrait;

    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    protected $request;

    /**
     * @var \Oro\Bundle\LocaleBundle\Entity\Repository\LocalizationRepository
     */
    protected $localizationRepository;

    /**
     * @var \Oro\Bundle\LocaleBundle\Entity\Localization
     */
    protected $localization;

    /**
     * Constructor
     *
     * @param \Oro\Bundle\LocaleBundle\Entity\Repository\LocalizationRepository $localizationRepository
     */
    public function __construct(LocalizationRepository $localizationRepository)
    {
        $this->localizationRepository = $localizationRepository;
    }

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
     * @param \Doctrine\Common\Collections\ArrayCollection $values
     * @return string
     * @throws \RuntimeException
     */
    public function getLocalizedValue($values)
    {
        if (!$this->localization) {
            $locale = $this->request->getLocale();
            $localization = $this->localizationRepository->findOneBy([ 'formattingCode' => $locale ]);

            if (!$localization) {
                throw new RuntimeException('Localization does not exist.');
            }

            $this->localization = $localization;
        }

        $value = $this->getLocalizedFallbackValue($values, $this->localization);

        return null !== $value->getString() ? $value->getString() : $value->getText();
    }

    public function getName()
    {
        return 'ds_locale_locale_extension';
    }
}
