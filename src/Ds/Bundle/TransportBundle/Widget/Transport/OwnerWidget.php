<?php

namespace Ds\Bundle\TransportBundle\Widget\Transport;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class OwnerWidget
 */
class OwnerWidget extends Widget
{
    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return 'ds.transport.widget.owner';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsTransportBundle/Resources/views/Transport/widget/owner.html.twig', $data);
    }
}
