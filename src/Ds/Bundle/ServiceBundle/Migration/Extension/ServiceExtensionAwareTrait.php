<?php

namespace Ds\Bundle\ServiceBundle\Migration\Extension;

/**
 * Trait ServiceExtensionAwareTrait
 */
trait ServiceExtensionAwareTrait
{
    /**
     * @var \Ds\Bundle\ServiceBundle\Migration\Extension\ServiceExtension
     */
    protected $serviceExtension; # region accessors

    /**
     * Sets the service extension
     *
     * @param \Ds\Bundle\ServiceBundle\Migration\Extension\ServiceExtension $serviceExtension
     */
    public function setServiceExtension(ServiceExtension $serviceExtension)
    {
        $this->serviceExtension = $serviceExtension;
    }

    # endregion
}
