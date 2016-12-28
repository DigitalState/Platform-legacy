<?php

namespace Ds\Bundle\CommunicationBundle\Migrations\Schema\v1_0;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Class DsCommunicationBundle
 */
class DsCommunicationBundle implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->createCommunicationTable($schema);
        $this->createCommunicationChannelTable($schema);
        $this->createCommunicationChannelDescriptionTable($schema);
        $this->createCommunicationChannelTitleTable($schema);
        $this->createCommunicationContentTable($schema);
        $this->createCommunicationCriterionTable($schema);
        $this->createCommunicationMessageTable($schema);
        $this->createCommunicationTemplateTable($schema);
        $this->addCommunicationForeignKeys($schema);
        $this->addCommunicationChannelForeignKeys($schema);
        $this->addCommunicationChannelDescriptionForeignKeys($schema);
        $this->addCommunicationChannelTitleForeignKeys($schema);
        $this->addCommunicationContentForeignKeys($schema);
        $this->addCommunicationCriterionForeignKeys($schema);
        $this->addCommunicationMessageForeignKeys($schema);
        $this->addCommunicationTemplateForeignKeys($schema);
    }

    /**
     * Create communication table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createCommunicationTable(Schema $schema)
    {
        $table = $schema->createTable('ds_comm');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('title', 'string', ['length' => 255]);
        $table->addColumn('description', 'text', ['notnull' => false]);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['business_unit_owner_id'], 'IDX_91AEB68259294170', []);
        $table->addIndex(['organization_id'], 'IDX_91AEB68232C8A3DE', []);
    }

    /**
     * Create communication channel table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createCommunicationChannelTable(Schema $schema)
    {
        $table = $schema->createTable('ds_comm_channel');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('default_to', 'string', ['length' => 255]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('icon', 'string', ['length' => 255]);
        $table->addColumn('implementation', 'string', ['length' => 255]);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['business_unit_owner_id'], 'IDX_4B7AE93959294170', []);
        $table->addIndex(['organization_id'], 'IDX_4B7AE93932C8A3DE', []);
    }

    /**
     * Create communication channel description table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createCommunicationChannelDescriptionTable(Schema $schema)
    {
        $table = $schema->createTable('ds_comm_channel_description');
        $table->addColumn('channel_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['channel_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_2645507FEB576E89');
        $table->addIndex(['channel_id'], 'IDX_2645507FED5CA9E6', []);
    }

    /**
     * Create communication channel title table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createCommunicationChannelTitleTable(Schema $schema)
    {
        $table = $schema->createTable('ds_comm_channel_title');
        $table->addColumn('channel_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['channel_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_A67F9A8BEB576E89');
        $table->addIndex(['channel_id'], 'IDX_A67F9A8BED5CA9E6', []);
    }

    /**
     * Create communication content table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createCommunicationContentTable(Schema $schema)
    {
        $table = $schema->createTable('ds_comm_content');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('communication_id', 'integer', ['notnull' => false]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('template_id', 'integer', ['notnull' => false]);
        $table->addColumn('channel_id', 'integer', ['notnull' => false]);
        $table->addColumn('profile_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('title', 'string', ['length' => 255]);
        $table->addColumn('presentation', 'text', ['notnull' => false]);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['communication_id'], 'IDX_174657D71C2D1E0C', []);
        $table->addIndex(['channel_id'], 'IDX_174657D772F5A1AA', []);
        $table->addIndex(['profile_id'], 'IDX_174657D7CCFA12B8', []);
        $table->addIndex(['template_id'], 'IDX_174657D75DA0FB8', []);
        $table->addIndex(['business_unit_owner_id'], 'IDX_174657D759294170', []);
        $table->addIndex(['organization_id'], 'IDX_174657D732C8A3DE', []);
    }

    /**
     * Create communication criterion table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createCommunicationCriterionTable(Schema $schema)
    {
        $table = $schema->createTable('ds_comm_criterion');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('communication_id', 'integer', ['notnull' => false]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('operand_1', 'string', ['length' => 255]);
        $table->addColumn('operator', 'string', ['length' => 255]);
        $table->addColumn('operand_2', 'string', ['length' => 255]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('implementation', 'string', ['length' => 255]);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['communication_id'], 'IDX_1EE86B711C2D1E0C', []);
        $table->addIndex(['business_unit_owner_id'], 'IDX_1EE86B7159294170', []);
        $table->addIndex(['organization_id'], 'IDX_1EE86B7132C8A3DE', []);
    }

    /**
     * Create communication message table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createCommunicationMessageTable(Schema $schema)
    {
        $table = $schema->createTable('ds_comm_message');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('communication_id', 'integer', ['notnull' => false]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('channel_id', 'integer', ['notnull' => false]);
        $table->addColumn('user_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('title', 'string', ['length' => 255]);
        $table->addColumn('presentation', 'text', ['notnull' => false]);
        $table->addColumn('sent_at', 'datetime', ['notnull' => false]);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['communication_id'], 'IDX_5F3E57011C2D1E0C', []);
        $table->addIndex(['user_id'], 'IDX_5F3E5701A76ED395', []);
        $table->addIndex(['channel_id'], 'IDX_5F3E570172F5A1AA', []);
        $table->addIndex(['business_unit_owner_id'], 'IDX_5F3E570159294170', []);
        $table->addIndex(['organization_id'], 'IDX_5F3E570132C8A3DE', []);
    }

    /**
     * Create communication template table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createCommunicationTemplateTable(Schema $schema)
    {
        $table = $schema->createTable('ds_comm_template');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('title', 'string', ['length' => 255]);
        $table->addColumn('presentation', 'text', ['notnull' => false]);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['business_unit_owner_id'], 'IDX_2034C0DF59294170', []);
        $table->addIndex(['organization_id'], 'IDX_2034C0DF32C8A3DE', []);
    }

    /**
     * Add communication foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addCommunicationForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_comm');
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

    /**
     * Add communication channel foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addCommunicationChannelForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_comm_channel');
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

    /**
     * Add communication channel description foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addCommunicationChannelDescriptionForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_comm_channel_description');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_comm_channel'),
            ['channel_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add communication channel title foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addCommunicationChannelTitleForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_comm_channel_title');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_comm_channel'),
            ['channel_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add communication content foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addCommunicationContentForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_comm_content');
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_comm'),
            ['communication_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
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
            $schema->getTable('ds_comm_template'),
            ['template_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_comm_channel'),
            ['channel_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_transport_profile'),
            ['profile_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
    }

    /**
     * Add communication criterion foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addCommunicationCriterionForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_comm_criterion');
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_comm'),
            ['communication_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
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

    /**
     * Add communication message foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addCommunicationMessageForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_comm_message');
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_comm'),
            ['communication_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
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
            $schema->getTable('ds_comm_channel'),
            ['channel_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_user'),
            ['user_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
    }

    /**
     * Add communication template foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addCommunicationTemplateForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_comm_template');
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
