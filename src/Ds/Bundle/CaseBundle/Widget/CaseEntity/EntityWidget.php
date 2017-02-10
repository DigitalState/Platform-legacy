<?php

namespace Ds\Bundle\CaseBundle\Widget\CaseEntity;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class EntityWidget
 */
class EntityWidget extends Widget
{
    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return 'ds.case.caseentity.widget.entity';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsCaseBundle/Resources/views/Case/widget/entity.html.twig', $data);
    }
}
