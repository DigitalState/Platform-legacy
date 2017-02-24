<?php

namespace Ds\Bundle\ServiceBundle\Migration\Extension;

/**
 * Interface ServiceExtensionAwareInterface
 */
interface ServiceExtensionAwareInterface
{
    /**
     * Sets the service extension
     *
     * @param \Ds\Bundle\ServiceBundle\Migration\Extension\ServiceExtension $serviceExtension
     */
    public function setServiceExtension(ServiceExtension $serviceExtension);
}
