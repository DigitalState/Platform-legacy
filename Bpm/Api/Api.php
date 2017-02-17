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
     * @param string $definitionId
     * @return string
     */
    public function getStartFormKey($definitionId);

    /**
     * Start an instance.
     *
     * @param string $definitionId
     * @param array $variables
     * @return object
     */
    public function startInstance($definitionId, array $variables = []);

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
