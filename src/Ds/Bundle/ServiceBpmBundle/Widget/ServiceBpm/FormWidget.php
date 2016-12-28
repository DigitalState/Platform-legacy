<?php

namespace Ds\Bundle\ServiceBpmBundle\Widget\ServiceBpm;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class FormWidget
 */
class FormWidget extends Widget
{
    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return 'ds.servicebpm.widget.form';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsServiceBpmBundle/Resources/views/ServiceBpm/widget/form.html.twig', $data);
    }
}
