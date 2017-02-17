<?php

namespace Ds\Bundle\CommunicationBundle\Widget\Communication\Criteria;

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
        return 'ds.communication.widget.criteria.grid';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsCommunicationBundle/Resources/views/Communication/Criteria/widget/grid.html.twig', $data);
    }
}
