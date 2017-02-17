<?php

namespace Ds\Bundle\AccountBundle\Event\Listener;

use Oro\Bundle\NavigationBundle\Event\ConfigureMenuEvent;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class NavigationListener
 */
class NavigationListener
{
    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    protected $stack;

    /**
     * Constructor
     *
     * @param \Symfony\Component\HttpFoundation\RequestStack $stack
     */
    public function __construct(RequestStack $stack)
    {
        $this->stack = $stack;
    }

    /**
     * Configure navigation callback
     *
     * @param ConfigureMenuEvent $event
     */
    public function onNavigationConfigure(ConfigureMenuEvent $event)
    {
        // @todo This is a quick solution. Ideal solution is to pass a routeParameter before route rendering.
        $menu = $event->getMenu();

        foreach ($menu as $item) {
            $locale = $this->stack->getCurrentRequest()->getLocale();
            $item->setUri(preg_replace('/\/en\//', '/' . $locale . '/', $item->getUri()));
        }
    }
}
