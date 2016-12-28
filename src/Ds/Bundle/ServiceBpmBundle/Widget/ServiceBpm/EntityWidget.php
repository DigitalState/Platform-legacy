<?php

namespace Ds\Bundle\ServiceBpmBundle\Widget\ServiceBpm;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class EntityWidget
 */
class EntityWidget extends Widget
{
    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return 'ds.servicebpm.widget.entity';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsServiceBpmBundle/Resources/views/ServiceBpm/widget/entity.html.twig', $data);
    }
}
