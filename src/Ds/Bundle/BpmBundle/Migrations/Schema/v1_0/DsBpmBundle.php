<?php

namespace Ds\Bundle\BpmBundle\Migrations\Schema\v1_0;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\EntityBundle\EntityConfig\DatagridScope;

/**
 * Class DsBpmBundle
 */
class DsBpmBundle implements Migration
{
    /**
     * Up
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     * @param \Oro\Bundle\MigrationBundle\Migration\QueryBag $queries
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $table = $schema->getTable('oro_user');
        $table->addColumn(
            'bpm_id',
            'string',
            [
                'oro_options' => [
                    'extend'   => [ 'owner' => ExtendScope::OWNER_CUSTOM ],
                    'datagrid' => [ 'is_visible' => DatagridScope::IS_VISIBLE_FALSE ],
                    'merge'    => [ 'display' => true ],
                ],
                'notnull' => false
            ]
        );
    }
}
