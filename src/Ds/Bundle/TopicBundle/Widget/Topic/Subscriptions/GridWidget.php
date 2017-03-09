<?php

namespace Ds\Bundle\TopicBundle\Widget\Topic\Subscriptions;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class GridWidget
 */
class GridWidget extends Widget
{
    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return 'ds.topic.widget.subscriptions.grid';
    }

    /**
     * Get content
     *
     * @param array $data
     * @return string
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsTopicBundle/Resources/views/Topic/Subscriptions/widget/grid.html.twig', $data);
    }
}
