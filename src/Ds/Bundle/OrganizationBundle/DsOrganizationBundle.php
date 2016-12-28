<?php

namespace Ds\Bundle\OrganizationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class DsOrganizationBundle
 */
class DsOrganizationBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'OroOrganizationBundle';
    }
}
