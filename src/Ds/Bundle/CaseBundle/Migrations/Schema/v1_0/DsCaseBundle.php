<?php

namespace Ds\Bundle\CaseBundle\Migrations\Schema\v1_0;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\NoteBundle\Migration\Extension\NoteExtensionAwareInterface;
use Oro\Bundle\NoteBundle\Migration\Extension\NoteExtension;
use Ds\Bundle\AssetBundle\Migration\Extension\AssetExtensionAwareInterface;
use Ds\Bundle\AssetBundle\Migration\Extension\AssetExtensionAwareTrait;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Class DsCaseBundle
 */
class DsCaseBundle implements Migration, NoteExtensionAwareInterface, AssetExtensionAwareInterface
{
    use AssetExtensionAwareTrait;

    /**
     * @var \Oro\Bundle\NoteBundle\Migration\Extension\NoteExtension
     */
    protected $noteExtension; # region accessors

    /**
     * {@inheritdoc}
     */
    public function setNoteExtension(NoteExtension $noteExtension)
    {
        $this->noteExtension = $noteExtension;
    }

    # endregion

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->createCaseTable($schema);
        $this->createCaseTitleTable($schema);
        $this->addCaseForeignKeys($schema);
        $this->addCaseTitleForeignKeys($schema);
        //$this->noteExtension->addNoteAssociation($schema, 'ds_case');
        //$this->assetExtension->addAssetAssociation($schema, 'ds_case');
    }

    /**
     * Create case table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createCaseTable(Schema $schema)
    {
        $table = $schema->createTable('ds_case');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('user_id', 'integer', ['notnull' => false]);
        $table->addColumn('service_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('source', 'string', ['length' => 255]);
        $table->addColumn('state', 'string', ['length' => 255]);
        $table->addColumn('status', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['user_id'], 'IDX_8C2CD6E5A76ED395', []);
        $table->addIndex(['service_id'], 'IDX_8C2CD6E5ED5CA9E6', []);
        $table->addIndex(['business_unit_owner_id'], 'IDX_8C2CD6E559294170', []);
        $table->addIndex(['organization_id'], 'IDX_8C2CD6E532C8A3DE', []);
    }

    /**
     * Create case title table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createCaseTitleTable(Schema $schema)
    {
        $table = $schema->createTable('ds_case_title');
        $table->addColumn('case_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['case_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_B28B3C50EB576E89');
        $table->addIndex(['case_id'], 'IDX_B28B3C50ED5CA9E6', []);
    }

    /**
     * Add case foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addCaseForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_case');
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
            $schema->getTable('ds_service'),
            ['service_id'],
            ['id'],
            ['onDelete' => 'SET NULL', 'onUpdate' => null]
        );
    }

    /**
     * Add case title foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addCaseTitleForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_case_title');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_case'),
            ['case_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }
}
