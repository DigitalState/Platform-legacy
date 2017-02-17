<?php

namespace Ds\Bundle\CommunicationBundle\Widget\Communication\Contents;

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
        return 'ds.communication.widget.contents.grid';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsCommunicationBundle/Resources/views/Communication/Contents/widget/grid.html.twig', $data);
    }
}
