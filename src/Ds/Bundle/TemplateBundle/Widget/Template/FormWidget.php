<?php

namespace Ds\Bundle\TemplateBundle\Widget\Template;

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
        return 'ds.template.widget.form';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsTemplateBundle/Resources/views/Template/widget/form.html.twig', $data);
    }
}
