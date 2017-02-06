<?php

namespace Ds\Bundle\ServiceBundle\Migration\Extension;

/**
 * Trait ServiceBpmExtensionAwareTrait
 */
trait ServiceBpmExtensionAwareTrait
{
    /**
     * @var \Ds\Bundle\ServiceBundle\Migration\Extension\ServiceBpmExtension
     */
    protected $serviceBpmExtension; # region accessors

    /**
     * Sets the service Bpm extension
     *
     * @param \Ds\Bundle\ServiceBundle\Migration\Extension\ServiceBpmExtension $serviceBpmExtension
     */
    public function setServiceBpmExtension(ServiceBpmExtension $serviceBpmExtension)
    {
        $this->serviceBpmExtension = $serviceBpmExtension;
    }

    # endregion
}
