<?php

namespace Ds\Bundle\BpmBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Oro\Bundle\ConfigBundle\DependencyInjection\SettingsBuilder;

/**
 * Class Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder;
        $rootNode = $treeBuilder->root('ds_bpm');

        SettingsBuilder::append($rootNode, [
            'variable_user' => [
                'type' => 'string',
                'value' => '_user'
            ],
            'variable_user_id' => [
                'type' => 'string',
                'value' => 'id'
            ],
            'variable_user_business_unit_id' => [
                'type' => 'string',
                'value' => 'business_unit_id'
            ],
            'variable_user_organization_id' => [
                'type' => 'string',
                'value' => 'organization_id'
            ],
            'variable_service' => [
                'type' => 'string',
                'value' => '_service'
            ],
            'variable_service_id' => [
                'type' => 'string',
                'value' => 'id'
            ],
            'variable_service_business_unit_id' => [
                'type' => 'string',
                'value' => 'business_unit_id'
            ],
            'variable_service_organization_id' => [
                'type' => 'string',
                'value' => 'organization_id'
            ],
            'variable_localization' => [
                'type' => 'string',
                'value' => '_localization'
            ],
            'variable_localization_id' => [
                'type' => 'string',
                'value' => 'id'
            ],
            'variable_localization_language_code' => [
                'type' => 'string',
                'value' => 'language_code'
            ],
            'variable_localization_formatting_code' => [
                'type' => 'string',
                'value' => 'formatting_code'
            ],
            'variable_none_start_event_form_data' => [
                'type' => 'string',
                'value' => '_start_form_data'
            ],
            'variable_none_start_event_form_validation' => [
                'type' => 'string',
                'value' => '_start_form_validation'
            ],
            'variable_none_start_event_form_validation_valid' => [
                'type' => 'string',
                'value' => 'valid'
            ],
            'variable_none_start_event_form_validation_message' => [
                'type' => 'string',
                'value' => 'message'
            ],
            'variable_user_task_form_data' => [
                'type' => 'string',
                'value' => '_task_{id}_form_data'
            ]
        ]);

        return $treeBuilder;
    }
}
