<?php

namespace Ds\Bundle\BpmBundle\Bpm\Api;

/**
 * Interface Api
 */
interface Api
{
    /**
     * Get start form key.
     *
     * @param string $processDefinitionId
     * @return string
     */
    public function getStartFormKey($processDefinitionId);

    /**
     * Start an instance.
     *
     * @param string $processDefinitionId
     * @param array $variables
     * @return object
     */
    public function startInstance($processDefinitionId, array $variables = []);

    /**
     * Get tasks.
     *
     * @param array $criteria
     * @return object
     */
    public function getTasks(array $criteria = []);

    /**
     * Get task count.
     *
     * @param array $criteria
     * @return integer
     */
    public function getTaskCount(array $criteria = []);

    /**
     * Get task.
     *
     * @param string $id
     * @return object
     */
    public function getTask($id);

    /**
     * Completed task.
     *
     * @param string $id
     * @param string $key
     * @param array $variables
     * @return object
     */
    public function completeTask($id, $key, array $variables = []);
}
