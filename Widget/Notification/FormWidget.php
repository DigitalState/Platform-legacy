<?php

namespace Ds\Bundle\NotificationBundle\Widget\Notification;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class FormWidget
 */
class FormWidget extends Widget
{
    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return 'ds.notification.widget.form';
    }

    /**
     * Get content
     *
     * @param array $data
     * @return string
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsNotificationBundle/Resources/views/Notification/widget/form.html.twig', $data);
    }
}
