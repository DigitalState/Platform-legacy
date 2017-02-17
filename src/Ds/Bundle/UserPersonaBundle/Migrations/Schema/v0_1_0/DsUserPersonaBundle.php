<?php

namespace Ds\Bundle\UserPersonaBundle\Migrations\Schema\v0_1_0;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Class DsUserPersonaBundle
 */
class DsUserPersonaBundle implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->createUserPersonaTable($schema);
        $this->createUserPersonaDefinitionTable($schema);
        $this->addUserPersonaForeignKeys($schema);
        $this->addUserPersonaDefinitionForeignKeys($schema);
    }

    /**
     * Create user persona table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createUserPersonaTable(Schema $schema)
    {
        $table = $schema->createTable('ds_user_persona');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('user_id', 'integer', ['notnull' => false]);
        $table->addColumn('definition_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('data', 'json_array', ['comment' => '(DC2Type:json_array)']);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['user_id'], 'IDX_D5583943A76ED395', []);
        $table->addIndex(['business_unit_owner_id'], 'IDX_D558394359294170', []);
        $table->addIndex(['organization_id'], 'IDX_D558394332C8A3DE', []);
        $table->addIndex(['definition_id'], 'IDX_D5583943D11EA911', []);
    }

    /**
     * Create user persona definition table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createUserPersonaDefinitionTable(Schema $schema)
    {
        $table = $schema->createTable('ds_user_persona_definition');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('title', 'string', ['length' => 255]);
        $table->addColumn('data', 'json_array', ['comment' => '(DC2Type:json_array)']);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->addColumn('slug', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['slug'], 'UNIQ_574092AA989D9B62');
        $table->addIndex(['business_unit_owner_id'], 'IDX_574092AA59294170', []);
        $table->addIndex(['organization_id'], 'IDX_574092AA32C8A3DE', []);
    }

    /**
     * Add user persona foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addUserPersonaForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_user_persona');
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
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_user'),
            ['user_id'],
            ['id'],
            ['onDelete' => 'SET NULL', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_user_persona_definition'),
            ['definition_id'],
            ['id'],
            ['onDelete' => 'SET NULL', 'onUpdate' => null]
        );
    }

    /**
     * Add user persona definition foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addUserPersonaDefinitionForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_user_persona_definition');
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
