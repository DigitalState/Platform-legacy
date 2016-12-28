<?php

namespace Ds\Bundle\RecordBundle\Widget\Record;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class OwnerWidget
 */
class OwnerWidget extends Widget
{
    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return 'ds.record.widget.owner';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsRecordBundle/Resources/views/Record/widget/owner.html.twig', $data);
    }
}
