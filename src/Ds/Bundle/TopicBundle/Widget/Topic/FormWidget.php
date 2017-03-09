<?php

namespace Ds\Bundle\TopicBundle\Widget\Topic;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class FormWidget
 */
class FormWidget extends Widget
{
    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return 'ds.topic.widget.form';
    }

    /**
     * Get content
     *
     * @param array $data
     * @return string
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsTopicBundle/Resources/views/Topic/widget/form.html.twig', $data);
    }
}
