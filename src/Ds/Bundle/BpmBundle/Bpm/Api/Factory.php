<?php

namespace Ds\Bundle\BpmBundle\Bpm\Api;

use Ds\Bundle\BpmBundle\Collection\Bpm\ApiCollection;

/**
 * Class Factory
 */
class Factory
{
    /**
     * @var \Ds\Bundle\BpmBundle\Collection\Bpm\ApiCollection
     */
    protected $apiCollection;

    /**
     * @var
     */
    protected $configuration;

    /**
     * Constructor.
     *
     * @param \Ds\Bundle\BpmBundle\Collection\Bpm\ApiCollection $apiCollection
     * @param $configuration
     */
    public function __construct(ApiCollection $apiCollection, $configuration)
    {
        $this->apiCollection = $apiCollection;
        $this->configuration = $configuration;
    }

    /**
     * Create api instance.
     *
     * @param string $alias
     */
    public function create($alias)
    {
        $api = clone $this->apiCollection->filter(function($item) use ($alias) {
            return $item['alias'] == $alias;
        })->first()['api'];

        // @todo The way we retrieve these configs is not ideal. Change it.

        $api->setHost($this->configuration->get('ds_bpm_' . $alias . '.host'));

        $variables = [
            'user' => $this->configuration->get('ds_bpm.variable_user'),
            'user_id' => $this->configuration->get('ds_bpm.variable_user_id'),
            'user_business_unit_id' => $this->configuration->get('ds_bpm.variable_user_business_unit_id'),
            'user_organization_id' => $this->configuration->get('ds_bpm.variable_user_organization_id'),
            'service' => $this->configuration->get('ds_bpm.variable_service'),
            'service_id' => $this->configuration->get('ds_bpm.variable_service_id'),
            'service_business_unit_id' => $this->configuration->get('ds_bpm.variable_service_business_unit_id'),
            'service_organization_id' => $this->configuration->get('ds_bpm.variable_service_organization_id'),
            'localization' => $this->configuration->get('ds_bpm.variable_localization'),
            'localization_id' => $this->configuration->get('ds_bpm.variable_localization_id'),
            'localization_language_code' => $this->configuration->get('ds_bpm.variable_localization_language_code'),
            'localization_formatting_code' => $this->configuration->get('ds_bpm.variable_localization_formatting_code'),
            'none_start_event_form_data' => $this->configuration->get('ds_bpm.variable_none_start_event_form_data'),
            'none_start_event_form_validation' => $this->configuration->get('ds_bpm.variable_none_start_event_form_validation'),
            'none_start_event_form_validation_valid' => $this->configuration->get('ds_bpm.variable_none_start_event_form_validation_valid'),
            'none_start_event_form_validation_message' => $this->configuration->get('ds_bpm.variable_none_start_event_form_validation_message'),
            'user_task_form_data' => $this->configuration->get('ds_bpm.variable_user_task_form_data'),
        ];
        $api->setVariables($variables);

        return $api;
    }
}
