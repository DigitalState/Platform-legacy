<?php

namespace Ds\Bundle\PortalBundle\Event\Listener;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Translation\DataCollectorTranslator;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class LocaleListener
 */
class LocaleListener
{
    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack
     */
    protected $stack;

    /**
     * @var \Symfony\Component\Translation\DataCollectorTranslator
     */
    protected $translator;

    /**
     * Constructor
     *
     * @param \Symfony\Component\HttpFoundation\RequestStack $stack
     * @param \Symfony\Component\Translation\DataCollectorTranslator $translator
     */
    public function __construct(RequestStack $stack, DataCollectorTranslator $translator)
    {
        $this->stack = $stack;
        $this->translator = $translator;
    }

    /**
     * On kernel request
     *
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $route = $this->stack->getCurrentRequest()->get('_route');

        //@todo change this condition to something appropriate.
        if (!preg_match('/^ds_portal/', $route)) {
            return;
        }

        $locale = $this->stack->getCurrentRequest()->getLocale();
        $this->translator->setLocale($locale);
    }
}
