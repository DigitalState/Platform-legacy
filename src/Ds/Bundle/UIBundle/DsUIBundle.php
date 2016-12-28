<?php

namespace Ds\Bundle\UIBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class DsUIBundle
 */
class DsUIBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'OroUIBundle';
    }
}
