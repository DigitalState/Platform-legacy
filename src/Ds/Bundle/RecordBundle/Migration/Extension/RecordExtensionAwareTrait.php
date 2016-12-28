<?php

namespace Ds\Bundle\RecordBundle\Migration\Extension;

/**
 * Trait RecordExtensionAwareInterface
 */
trait RecordExtensionAwareTrait
{
    /**
     * @var \Ds\Bundle\RecordBundle\Migration\Extension\RecordExtension
     */
    protected $recordExtension; # region accessors

    /**
     * {@inheritdoc}
     */
    public function setRecordExtension(RecordExtension $recordExtension)
    {
        $this->recordExtension = $recordExtension;
    }

    # endregion
}
