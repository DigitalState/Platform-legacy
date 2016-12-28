<?php

namespace Ds\Bundle\WidgetBundle\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class WidgetCollection
 */
class WidgetCollection extends ArrayCollection
{
    /**
     * Add widget
     *
     * @param \Ds\Bundle\WidgetBundle\Widget\Widget $widget
     * @param string $position
     * @param string $context
     * @return \Ds\Bundle\WidgetBundle\Collection\WidgetCollection
     */
    public function addWidget(Widget $widget, $position = null, $context = null)
    {
        return $this->add([
            'widget' => $widget,
            'position' => $position,
            'context' => $context
        ]);
    }
}
