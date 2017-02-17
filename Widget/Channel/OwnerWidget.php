<?php

namespace Ds\Bundle\CommunicationBundle\Widget\Channel;

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
        return 'ds.communication.channel.widget.owner';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsCommunicationBundle/Resources/views/Channel/widget/owner.html.twig', $data);
    }
}
