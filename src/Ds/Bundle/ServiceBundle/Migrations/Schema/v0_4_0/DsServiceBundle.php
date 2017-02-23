<?php

namespace Ds\Bundle\ServiceBundle\Migrations\Schema\v0_4_0;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Class DsServiceBundle
 */
class DsServiceBundle implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->addServiceEnabledColumn($schema);
    }

    /**
     * Add service enabled column.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addServiceEnabledColumn(Schema $schema)
    {
        $table = $schema->getTable('ds_service');
        $table->addColumn(
            'enabled',
            'tinyint',
            [
                'notnull' => true
            ]
        );
    }
}
