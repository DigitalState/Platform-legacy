<?php

namespace Ds\Bundle\TopicBundle\Widget\Topic;

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
        return 'ds.topic.widget.owner';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsTopicBundle/Resources/views/Topic/widget/owner.html.twig', $data);
    }
}
