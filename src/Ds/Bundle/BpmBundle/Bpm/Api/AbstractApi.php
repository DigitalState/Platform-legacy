<?php

namespace Ds\Bundle\BpmBundle\Bpm\Api;

/**
 * Class AbstractApi
 */
abstract class AbstractApi implements Api
{
    /**
     * @var string
     */
    protected $host; # region accessors

    /**
     * Set the host.
     *
     * @param string $host
     * @return \Ds\Bundle\BpmBundle\Bpm\Api\AbstractApi
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get host.
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    # endregion

    /**
     * @var array
     */
    protected $variables; # region accessors

    /**
     * Set the variables.
     *
     * @param array $variables
     * @return \Ds\Bundle\BpmBundle\Bpm\Api\AbstractApi
     */
    public function setVariables($variables)
    {
        $this->variables = $variables;

        return $this;
    }

    /**
     * Get variables.
     *
     * @return array
     */
    public function getVariables()
    {
        return $this->variables;
    }

    # endregion

    /**
     * Constructor
     *
     * @param string $host
     */
    public function __construct($host = null)
    {
        $this->host = $host;
        $this->variables = [];
    }
}
