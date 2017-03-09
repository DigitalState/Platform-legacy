<?php

namespace Ds\Bundle\TemplateBundle\Migrations\Schema\v0_4_0;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Class DsTemplateBundle
 */
class DsTemplateBundle implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        /** Tables generation **/
        $this->createDsTemplateTable($schema);

        /** Foreign keys generation **/
        $this->addDsTemplateForeignKeys($schema);
    }

    /**
     * Create ds_template table
     *
     * @param Schema $schema
     */
    protected function createDsTemplateTable(Schema $schema)
    {
        $table = $schema->createTable('ds_template');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('title', 'string', ['length' => 255]);
        $table->addColumn('presentation', 'text', ['notnull' => false]);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['business_unit_owner_id'], 'IDX_C95D248059294170', []);
        $table->addIndex(['organization_id'], 'IDX_C95D248032C8A3DE', []);
    }

    /**
     * Add ds_template foreign keys.
     *
     * @param Schema $schema
     */
    protected function addDsTemplateForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_template');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_organization'),
            ['organization_id'],
            ['id'],
            ['onDelete' => 'SET NULL', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_business_unit'),
            ['business_unit_owner_id'],
            ['id'],
            ['onDelete' => 'SET NULL', 'onUpdate' => null]
        );
    }
}
