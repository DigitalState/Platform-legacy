<?php

namespace Ds\Bundle\SSOLinkedinBundle\DependencyInjection\Compiler;

use Ds\Bundle\SSOBundle\DependencyInjection\Compiler\AbstractHwiConfigurationPass;

/**
 * Class HwiConfigurationPass
 */
class HwiConfigurationPass extends AbstractHwiConfigurationPass
{
    /**
     * @const string
     */
    const RESOURCE_OWNER = 'linkedin';
}
