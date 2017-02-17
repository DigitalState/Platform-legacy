<?php

namespace Ds\Bundle\WidgetBundle\Widget;

use Symfony\Component\Templating\EngineInterface;

/**
 * Class Widget
 */
abstract class Widget
{
    /**
     * @var \Symfony\Component\Templating\EngineInterface
     */
    protected $templating;

    /**
     * Constructor
     *
     * @param \Symfony\Component\Templating\EngineInterface $templating
     */
    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    /**
     * Get title
     *
     * @return string
     */
    public abstract function getTitle();

    /**
     * Get content
     *
     * @param array $data
     * @return string
     */
    public abstract function getContent(array $data = []);
}
