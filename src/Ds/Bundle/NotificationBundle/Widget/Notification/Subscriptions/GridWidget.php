<?php

namespace Ds\Bundle\NotificationBundle\Widget\Notification\Subscriptions;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class GridWidget
 */
class GridWidget extends Widget
{
    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return 'ds.notification.widget.subscriptions.grid';
    }

    /**
     * Get content
     *
     * @param array $data
     * @return string
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsNotificationBundle/Resources/views/Notification/Subscriptions/widget/grid.html.twig', $data);
    }
}
