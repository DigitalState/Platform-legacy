<?php

namespace Ds\Bundle\AccountCaseStatusBundle\Widget\Account\CaseEntity\Status;

use Ds\Bundle\WidgetBundle\Widget\Widget;
use Symfony\Component\Templating\EngineInterface;
use Ds\Bundle\CaseStatusBundle\Manager\StatusManager;

/**
 * Class GridWidget
 */
class GridWidget extends Widget
{
    /**
     * @var \Ds\Bundle\CaseStatusBundle\Manager\StatusManager
     */
    protected $manager;

    /**
     * Constructor
     *
     * @param \Symfony\Component\Templating\EngineInterface $templating
     * @param \Ds\Bundle\CaseStatusBundle\Manager\StatusManager $manager
     */
    public function __construct(EngineInterface $templating, StatusManager $manager)
    {
        parent::__construct($templating);

        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return 'ds.accountcasestatus.case.status.widget.grid';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        $data['statuses'] = $this->manager->getList(null, null, [ 'case' => $data['case'] ], [ 'createdAt' => 'DESC' ]);

        return $this->templating->render('@DsAccountCaseStatusBundle/Resources/views/Account/Case/Status/widget/grid.html.twig', $data);
    }
}
