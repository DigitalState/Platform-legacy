<?php

namespace Ds\Bundle\BpmBundle\Event\Bpm\Instance\Start;

use Symfony\Component\EventDispatcher\Event;
use Ds\Bundle\BpmBundle\Attribute;

/**
 * Class PreEvent
 */
class PreEvent extends Event
{
    /**
     * @const string
     */
    const NAME = 'ds.event.bpm.instance.start.pre';

    use Attribute\Definition\Id;
    use Attribute\Variables;

    /**
     * Constructor
     *
     * @param string $definitionId
     * @param array $variables
     */
    public function __construct($definitionId, array $variables = [])
    {
        $this->definitionId = $definitionId;
        $this->variables = $variables;
    }
}
