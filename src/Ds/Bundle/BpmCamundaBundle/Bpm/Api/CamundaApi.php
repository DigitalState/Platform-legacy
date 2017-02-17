<?php

namespace Ds\Bundle\BpmCamundaBundle\Bpm\Api;

use Ds\Bundle\BpmBundle\Bpm\Api\AbstractApi;
use \org\camunda\php\sdk;

/**
 * Class CamundaApi
 */
class CamundaApi extends AbstractApi
{
    /**
     * {@inheritdoc}
     */
    public function getStartFormKey($definitionId)
    {
        $processDefinitionRequest = new sdk\entity\request\ProcessDefinitionRequest;
        $processDefinitionRequest
            ->setKey($definitionId)
            ->setLatest(true);
        $processDefinition = $this->getApi()->processDefinition->getDefinitions($processDefinitionRequest)->definition_0;

        $key = $this->getApi()->processDefinition->getStartFormKey($processDefinition->getId())->getKey();

        return $key;
    }

    /**
     * {@inheritdoc}
     */
    protected function _startInstance($processDefinitionId, array $variables = [])
    {
        $processDefinitionRequest = new sdk\entity\request\ProcessDefinitionRequest;
        $processDefinitionRequest
            ->setKey($processDefinitionId)
            ->setLatest(true);
        $processDefinition = $this->getApi()->processDefinition->getDefinitions($processDefinitionRequest)->definition_0;

        $variables = (object) [
            $this->variables['user'] => (object) [
                'value' => json_encode([
                    $this->variables['user_id'] => $variables['user']['id'],
                    $this->variables['user_business_unit_id'] => $variables['user']['business_unit_id'],
                    $this->variables['user_organization_id'] => $variables['user']['organization_id']
                ]),
                'type' => 'json',
                'valueInfo' => (object) []
            ],
            $this->variables['service'] => (object) [
                'value' => json_encode([
                    $this->variables['service_id'] => $variables['service']['id'],
                    $this->variables['service_business_unit_id'] => $variables['service']['business_unit_id'],
                    $this->variables['service_organization_id'] => $variables['service']['organization_id']
                ]),
                'type' => 'json',
                'valueInfo' => (object) []
            ],
            $this->variables['localization'] => (object) [
                'value' => json_encode([
                    $this->variables['localization_id'] => $variables['localization']['id'],
                    $this->variables['localization_language_code'] => $variables['localization']['language_code'],
                    $this->variables['localization_formatting_code'] => $variables['localization']['formatting_code']
                ]),
                'type' => 'json',
                'valueInfo' => (object) []
            ],
            $this->variables['none_start_event_form_data'] => (object) [
                'value' => json_encode($variables['none_start_event_form_data']),
                'type' => 'json',
                'valueInfo' => (object) []
            ]
        ];

        $processDefinitionRequest = new sdk\entity\request\ProcessDefinitionRequest;
        $processDefinitionRequest->setVariables($variables);
        $processInstance = $this->getApi()->processDefinition->startInstance($processDefinition->getId(), $processDefinitionRequest);

        return $processInstance;
    }

    /**
     * {@inheritdoc}
     */
    public function getTasks(array $criteria = [])
    {
        $taskRequest = new sdk\entity\request\TaskRequest;

        if (array_key_exists('assignee', $criteria)) {
            $taskRequest->setAssignee($criteria['assignee']);
        }

        return (array) $this->getApi()->task->getTasks($taskRequest);
    }

    /**
     * {@inheritdoc}
     */
    public function getTaskCount(array $criteria = [])
    {
        $taskRequest = new sdk\entity\request\TaskRequest;

        if (array_key_exists('assignee', $criteria)) {
            $taskRequest->setAssignee($criteria['assignee']);
        }

        return $this->getApi()->task->getCount($taskRequest);
    }

    /**$this->getApi()->processDefinition->getDefinitions($processDefinitionRequest)
     * {@inheritdoc}
     */
    public function getTask($id)
    {
        return $this->getApi()->task->getTask($id);
    }

    /**
     * {@inheritdoc}
     */
    public function completeTask($id, $key, array $variables = [])
    {
        $variables = (object) [
            strtr($this->variables['user_task_form_data'], [ '{id}' => $key ]) => (object) [
                'value' => json_encode($variables['user_task_form_data']),
                'type' => 'json',
                'valueInfo' => (object) []
            ]
        ];
        $taskRequest = new sdk\entity\request\TaskRequest;
        $taskRequest->setVariables($variables);
        $this->getApi()->task->completeTask($id, $taskRequest);
    }

    /**
     * Get sdk api instance.
     *
     * @return \org\camunda\php\sdk\Api
     */
    protected function getApi()
    {
        return new sdk\Api($this->host);
    }
}
