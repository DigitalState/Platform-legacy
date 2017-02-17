<?php

namespace Ds\Bundle\BpmBundle\Event\Bpm\Instance\Start;

use Symfony\Component\EventDispatcher\Event;
use Ds\Bundle\BpmBundle\Attribute;

/**
 * Class PostEvent
 */
class PostEvent extends Event
{
    /**
     * @const string
     */
    const NAME = 'ds.event.bpm.instance.start.post';

    use Attribute\Instance;

    /**
     * Constructor
     *
     * @param object $instance
     */
    public function __construct($instance)
    {
        $this->instance = $instance;
    }
}
