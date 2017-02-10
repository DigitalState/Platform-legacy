<?php

namespace Ds\Bundle\CaseBundle\Widget\CaseEntity;

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
        return 'ds.case.caseentity.widget.form';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsCaseBundle/Resources/views/Case/widget/form.html.twig', $data);
    }
}
