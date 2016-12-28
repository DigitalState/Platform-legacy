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
            'variable_user_id' => [
                'type' => 'string',
                'value' => '_user_id'
            ],
            'variable_user_business_unit_id' => [
                'type' => 'string',
                'value' => '_user_business_unit_id'
            ],
            'variable_user_organization_id' => [
                'type' => 'string',
                'value' => '_user_organization_id'
            ],
            'variable_service_id' => [
                'type' => 'string',
                'value' => '_service_id'
            ],
            'variable_service_business_unit_id' => [
                'type' => 'string',
                'value' => '_service_business_unit_id'
            ],
            'variable_service_organization_id' => [
                'type' => 'string',
                'value' => '_service_organization_id'
            ],
            'variable_none_start_event_form_data' => [
                'type' => 'string',
                'value' => '_start_form_data'
            ],
            'variable_user_task_form_data' => [
                'type' => 'string',
                'value' => '_task_{id}_form_data'
            ]
        ]);

        return $treeBuilder;
    }
}
