<?php

namespace Ds\Bundle\CaseStatusBundle\Widget\Status;

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
        return 'ds.casestatus.status.widget.form';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsCaseStatusBundle/Resources/views/Status/widget/form.html.twig', $data);
    }
}
