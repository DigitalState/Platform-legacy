<?php

namespace Ds\Bundle\CommunicationBundle\Widget\Content;

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
        return 'ds.communication.content.widget.entity';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsCommunicationBundle/Resources/views/Content/widget/entity.html.twig', $data);
    }
}
