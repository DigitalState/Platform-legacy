<?php

namespace Ds\Bundle\RecordBundle\Migrations\Schema\v0_2_1;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\AttachmentBundle\Migration\Extension\AttachmentExtension;
use Oro\Bundle\AttachmentBundle\Migration\Extension\AttachmentExtensionAwareInterface;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Class DsRecordBundle
 */
class DsRecordBundle implements Migration, AttachmentExtensionAwareInterface
{
    /**
     * @var AttachmentExtension
     */
    protected $attachmentExtension; # region accessors

    /**
     * {@inheritdoc}
     */
    public function setAttachmentExtension(AttachmentExtension $attachmentExtension)
    {
        $this->attachmentExtension = $attachmentExtension;
    }

    # endregion

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->addAttachmentAssociation($schema);
    }

    /**
     * Add record file attachment association.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addAttachmentAssociation(Schema $schema)
    {
        $this->attachmentExtension->addAttachmentAssociation(
            $schema,
            'ds_record',
            [],
            8
        );
    }
}
