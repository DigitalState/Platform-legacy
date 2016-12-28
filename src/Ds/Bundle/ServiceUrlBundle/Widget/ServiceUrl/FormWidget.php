<?php

namespace Ds\Bundle\ServiceUrlBundle\Widget\ServiceUrl;

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
        return 'ds.serviceurl.widget.form';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsServiceUrlBundle/Resources/views/ServiceUrl/widget/form.html.twig', $data);
    }
}
