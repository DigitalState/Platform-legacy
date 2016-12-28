<?php

namespace Ds\Bundle\NotificationBundle\Widget\Subscription;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class EntityWidget
 */
class EntityWidget extends Widget
{
    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return 'ds.notification.subscription.widget.entity';
    }

    /**
     * Get content
     *
     * @param array $data
     * @return string
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsNotificationBundle/Resources/views/Subscription/widget/entity.html.twig', $data);
    }
}
