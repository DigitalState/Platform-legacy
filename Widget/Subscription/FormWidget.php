<?php

namespace Ds\Bundle\NotificationBundle\Widget\Subscription;

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
        return 'ds.notification.subscription.widget.form';
    }

    /**
     * Get content
     *
     * @param array $data
     * @return string
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsNotificationBundle/Resources/views/Subscription/widget/form.html.twig', $data);
    }
}
