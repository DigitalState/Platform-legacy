<?php

namespace Ds\Bundle\WidgetBundle\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFunction;
use Ds\Bundle\WidgetBundle\Collection\WidgetCollection;
use InvalidArgumentException;

/**
 * Class WidgetExtension
 */
class WidgetExtension extends Twig_Extension
{
    /**
     * @var \Ds\Bundle\WidgetBundle\Collection\WidgetCollection
     */
    protected $collection;

    /**
     * Constructor
     *
     * @param \Ds\Bundle\WidgetBundle\Collection\WidgetCollection $collection
     */
    public function __construct(WidgetCollection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Get functions
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('ds_widgets', [ $this, 'getWidgets' ]),
        ];
    }

    /**
     * Get widgets
     *
     * @param array $criteria
     * @param array $data
     * @return array
     * @throws InvalidArgumentException
     */
    public function getWidgets(array $criteria, array $data = [])
    {
        $criteria += [ 'position' => null, 'context' => null];

        if (count($criteria) !== 2) {
            throw new InvalidArgumentException('Criteria must contain "position" and "context" indexes only.');
        }

        $widgets = [];

        foreach ($this->collection->getIterator() as $widget) {
            if ($widget['position'] === $criteria['position'] && (null === $widget['context'] || $widget['context'] === $criteria['context'])) {
                $widgets[] = [
                    'title' => $widget['widget']->getTitle(),
                    'content' => $widget['widget']->getContent($data)
                ];
            }
        }

        return $widgets;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return 'ds_widget_widget_extension';
    }
}
