<?php

namespace Ds\Bundle\TransportBundle\Widget\Profile;

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
        return 'ds.transport.profile.widget.entity';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsTransportBundle/Resources/views/Profile/widget/entity.html.twig', $data);
    }
}
