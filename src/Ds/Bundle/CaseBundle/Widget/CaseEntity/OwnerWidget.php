<?php

namespace Ds\Bundle\CaseBundle\Widget\CaseEntity;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class OwnerWidget
 */
class OwnerWidget extends Widget
{
    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return 'ds.case.caseentity.widget.owner';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsCaseBundle/Resources/views/Case/widget/owner.html.twig', $data);
    }
}
