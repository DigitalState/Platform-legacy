<?php

namespace Ds\Bundle\BpmBundle\Attribute;

/**
 * Trait Host
 */
trait Host
{
    /**
     * @var string
     */
    protected $host; # region accessors

    /**
     * Set host
     *
     * @param string $host
     * @return object
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get host
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    #endregion
}
