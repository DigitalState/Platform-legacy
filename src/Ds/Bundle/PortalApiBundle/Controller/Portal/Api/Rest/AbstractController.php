<?php

namespace Ds\Bundle\PortalApiBundle\Controller\Portal\Api\Rest;

use Ds\Bundle\ApiBundle\Controller\Api\Rest\AbstractController as BaseAbstractController;
use Oro\Bundle\LocaleBundle\Entity\FallbackTrait;

/**
 * Class AbstractController
 */
abstract class AbstractController extends BaseAbstractController
{
    use FallbackTrait;

    /**
     * @param $values
     * @return mixed
     */
    protected function transformLocalizedValuesToCurrentLocaleText($values)
    {
        $request = $this->get('request');
        $locale = $request->getLocale();

        foreach ($values as $value) {
            $localization = $value->getLocalization();
            $code = $localization ? $localization->getFormattingCode() : 'default';

            if ($locale === $code) {
                return $this->getLocalizedFallbackValue($values, $localization)->getText();
            }
        }

        return $this->getLocalizedFallbackValue($values, null)->getText();
    }
}
