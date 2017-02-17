<?php

namespace Ds\Bundle\CommunicationBundle\Widget\Criterion;

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
        return 'ds.communication.criterion.widget.form';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsCommunicationBundle/Resources/views/Criterion/widget/form.html.twig', $data);
    }
}
