<?php

namespace Ds\Bundle\BpmBundle\Bpm\Api;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Ds\Bundle\BpmBundle\Attribute;
use Ds\Bundle\BpmBundle\Event\Bpm;

/**
 * Class AbstractApi
 */
abstract class AbstractApi implements Api
{
    use Attribute\Host;
    use Attribute\Variables;

    /**
     * @var \Symfony\Component\EventDispatcher\EventDispatcher
     */
    protected $dispatcher;

    /**
     * Constructor
     *
     * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        $this->variables = [];
    }

    /**
     * {@inheritdoc}
     */
    public function startInstance($definitionId, array $variables = [])
    {
        $event = new Bpm\Instance\Start\PreEvent($definitionId, $variables);
        $this->dispatcher->dispatch(Bpm\Instance\Start\PreEvent::NAME, $event);
        $definitionId = $event->getDefinitionId();
        $variables = $event->getVariables();

        $instance = $this->_startInstance($definitionId, $variables);

        $event = new Bpm\Instance\Start\PostEvent($instance);
        $this->dispatcher->dispatch(Bpm\Instance\Start\PostEvent::NAME, $event);
        $instance = $event->getInstance();

        return $instance;
    }

    /**
     * Start an instance.
     *
     * @param string $definitionId
     * @param array $variables
     * @return object
     */
    protected abstract function _startInstance($definitionId, array $variables = []);
}
