<?php

namespace Ds\Bundle\TopicBundle\Widget\Topic;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class EntityWidget
 */
class EntityWidget extends Widget
{
    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return 'ds.topic.widget.entity';
    }

    /**
     * Get content
     *
     * @param array $data
     * @return string
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsTopicBundle/Resources/views/Topic/widget/entity.html.twig', $data);
    }
}
