<?php

namespace Ds\Bundle\ServiceBundle\Migration\Extension;

/**
 * Interface ServiceBpmExtensionAwareInterface
 */
interface ServiceBpmExtensionAwareInterface
{
    /**
     * Sets the service Bpm extension
     *
     * @param \Ds\Bundle\ServiceBundle\Migration\Extension\ServiceBpmExtension $serviceBpmExtension
     */
    public function setServiceBpmExtension(ServiceBpmExtension $serviceBpmExtension);
}
