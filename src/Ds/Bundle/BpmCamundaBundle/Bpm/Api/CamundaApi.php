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
    public function __construct($host = 'http://localhost:8080/engine-rest')
    {
        parent::__construct($host);
    }

    /**
     * {@inheritdoc}
     */
    public function getStartFormKey($processDefinitionId)
    {
        $processDefinitionRequest = new sdk\entity\request\ProcessDefinitionRequest;
        $processDefinitionRequest
            ->setKey($processDefinitionId)
            ->setLatest(true);
        $processDefinition = $this->getApi()->processDefinition->getDefinitions($processDefinitionRequest)->definition_0;

        $key = $this->getApi()->processDefinition->getStartFormKey($processDefinition->getId())->getKey();

        return $key;
    }

    /**
     * {@inheritdoc}
     */
    public function startInstance($processDefinitionId, array $variables = [])
    {
        $processDefinitionRequest = new sdk\entity\request\ProcessDefinitionRequest;
        $processDefinitionRequest
            ->setKey($processDefinitionId)
            ->setLatest(true);
        $processDefinition = $this->getApi()->processDefinition->getDefinitions($processDefinitionRequest)->definition_0;

        $variables = (object) [
            $this->variables['none_start_event_form_data'] => (object) [
                'value' => json_encode($variables['none_start_event_form_data']),
                'type' => 'json',
                'valueInfo' => (object) []
            ],
            $this->variables['user_id'] => (object) [
                'value' => $variables['user_id'],
                'type' => 'string',
                'valueInfo' => (object) []
            ],
            $this->variables['user_business_unit_id'] => (object) [
                'value' => $variables['user_business_unit_id'],
                'type' => 'string',
                'valueInfo' => (object) []
            ],
            $this->variables['user_organization_id'] => (object) [
                'value' => $variables['user_organization_id'],
                'type' => 'string',
                'valueInfo' => (object) []
            ],
            $this->variables['service_id'] => (object) [
                'value' => $variables['service_id'],
                'type' => 'string',
                'valueInfo' => (object) []
            ],
            $this->variables['service_business_unit_id'] => (object) [
                'value' => $variables['service_business_unit_id'],
                'type' => 'string',
                'valueInfo' => (object) []
            ],
            $this->variables['service_organization_id'] => (object) [
                'value' => $variables['service_organization_id'],
                'type' => 'string',
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
