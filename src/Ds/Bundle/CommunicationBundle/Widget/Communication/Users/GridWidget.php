<?php

namespace Ds\Bundle\CommunicationBundle\Widget\Communication\Users;

use Ds\Bundle\WidgetBundle\Widget\Widget;
use Symfony\Component\Templating\EngineInterface;
use Ds\Bundle\CommunicationBundle\Manager\CommunicationManager;

/**
 * Class GridWidget
 */
class GridWidget extends Widget
{
    /**
     * @var \Ds\Bundle\CommunicationBundle\Manager\CommunicationManager
     */
    protected $communicationManager;

    /**
     * Constructor
     *
     * @param \Symfony\Component\Templating\EngineInterface $templating
     * @param \Ds\Bundle\CommunicationBundle\Manager\CommunicationManager $communicationManager
     */
    public function __construct(EngineInterface $templating, CommunicationManager $communicationManager)
    {
        parent::__construct($templating);

        $this->communicationManager = $communicationManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return 'ds.communication.widget.users.grid';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsCommunicationBundle/Resources/views/Communication/Users/widget/grid.html.twig', $data);
    }
}
