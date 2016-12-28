<?php

namespace Ds\Bundle\CaseStatusBundle\Widget\CaseEntity\Statuses;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class GridWidget
 */
class GridWidget extends Widget
{
    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return 'ds.casestatus.caseentity.widget.statuses.grid';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsCaseStatusBundle/Resources/views/Case/Statuses/widget/grid.html.twig', $data);
    }
}
