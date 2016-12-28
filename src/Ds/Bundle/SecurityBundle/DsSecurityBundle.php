<?php

namespace Ds\Bundle\SecurityBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class DsSecurityBundle
 */
class DsSecurityBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'OroSecurityBundle';
    }
}
