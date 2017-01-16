<?php

namespace Ds\Bundle\ApiBundle\Controller\Api\Rest;

use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;
use Doctrine\Common\Collections\ArrayCollection;
use Oro\Bundle\LocaleBundle\Entity\FallbackTrait;

/**
 * Class AbstractController
 */
abstract class AbstractController extends RestController
{
    use FallbackTrait;

    /**
     * {@inheritdoc}
     */
    protected function transformEntityField($field, &$value)
    {
        switch ($field) {
            case 'owner':
            case 'organization':
                $value = $this->transformEntityToId($value);
                break;

            default:
                parent::transformEntityField($field, $value);
        }
    }

    /**
     * Transform localized values to texts
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $values
     * @return array
     */
    protected function transformLocalizedValuesToTexts($values)
    {
        $array = [];

        foreach ($values as $value) {
            $localization = $value->getLocalization();
            $code = $localization ? $localization->getFormattingCode() : 'default';
            $text = $this->getLocalizedFallbackValue($values, $localization)->getText();
            $array[$code] = $text;
        }

        return $array;
    }

    /**
     * Transform entity to id
     *
     * @param object $value
     * @return mixed
     */
    protected function transformEntityToId($value)
    {
        if ($value) {
            $value = $value->getId();
        }

        return $value;
    }

    /**
     * Transform entities to ids
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $values
     * @return array
     */
    protected function transformEntitiesToIds($values)
    {
        $array = [];

        foreach ($values as $value) {
            $array[] = $this->transformEntityToId($value);
        }

        return $array;
    }

    /**
     * Get fallback localization fields
     *
     * @return array
     */
    protected function getFallbackLocalizationFields()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    protected function fixFormData(array &$data, $entity)
    {
        $localizationRepository = $this->get('oro_locale.repository.localization');
        $fields = $this->getFallbackLocalizationFields();

        if (!$fields) {
            return false;
        }

        foreach ($fields as $field) {
            if (array_key_exists($field, $data)) {
                $translations = $data[$field];
                unset($data[$field]);

                foreach ($translations as $formattingCode => $value) {
                    if ('default' == $formattingCode) {
                        $data[$field]['values']['default'] = $value;
                    } else {
                        $localization = $localizationRepository->findOneBy(['formattingCode' => $formattingCode]);
                        $data[$field]['values']['localizations'][$localization->getId()] = [
                            'value' => $value,
                            'use_fallback' => false,
                            'fallback' => 'system'
                        ];
                    }
                }
            }
        }

        return true;
    }
}
