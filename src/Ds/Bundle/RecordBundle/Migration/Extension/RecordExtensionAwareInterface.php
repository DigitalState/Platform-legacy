<?php

namespace Ds\Bundle\RecordBundle\Migration\Extension;

/**
 * Interface RecordExtensionAwareInterface
 */
interface RecordExtensionAwareInterface
{
    /**
     * Sets the record extension
     *
     * @param \Ds\Bundle\RecordBundle\Migration\Extension\RecordExtension $recordExtension
     */
    public function setRecordExtension(RecordExtension $recordExtension);
}
