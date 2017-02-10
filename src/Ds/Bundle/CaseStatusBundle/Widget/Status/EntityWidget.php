<?php

namespace Ds\Bundle\CaseStatusBundle\Widget\Status;

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
        return 'ds.casestatus.status.widget.entity';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsCaseStatusBundle/Resources/views/Status/widget/entity.html.twig', $data);
    }
}
