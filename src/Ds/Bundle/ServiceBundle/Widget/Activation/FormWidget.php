<?php

namespace Ds\Bundle\ServiceBundle\Widget\Activation;

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
        return 'ds.service.activation.widget.form';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsServiceBundle/Resources/views/Activation/widget/form.html.twig', $data);
    }
}
