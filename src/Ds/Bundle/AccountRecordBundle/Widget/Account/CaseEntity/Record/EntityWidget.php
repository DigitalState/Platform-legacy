<?php

namespace Ds\Bundle\AccountRecordBundle\Widget\Account\CaseEntity\Record;

use Ds\Bundle\WidgetBundle\Widget\Widget;
use Symfony\Component\Templating\EngineInterface;
use Ds\Bundle\RecordBundle\Manager\RecordManager;

/**
 * Class EntityWidget
 */
class EntityWidget extends Widget
{
    /**
     * @var \Ds\Bundle\RecordBundle\Manager\RecordManager
     */
    protected $manager;

    /**
     * Constructor
     *
     * @param \Symfony\Component\Templating\EngineInterface $templating
     * @param \Ds\Bundle\RecordBundle\Manager\RecordManager $manager
     */
    public function __construct(EngineInterface $templating, RecordManager $manager)
    {
        parent::__construct($templating);

        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return 'ds.accountrecord.case.record.widget.entity';
    }

    /**
     * {@inheritdoc}s
     */
    public function getContent(array $data = [])
    {
        $data['records'] = $this->manager->getList(null, null, [ 'case' => $data['case'] ], [ 'createdAt' => 'DESC' ]);

        return $this->templating->render('@DsAccountRecordBundle/Resources/views/Account/Case/Record/widget/entity.html.twig', $data);
    }
}
