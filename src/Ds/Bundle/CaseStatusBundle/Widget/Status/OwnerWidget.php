<?php

namespace Ds\Bundle\CaseStatusBundle\Widget\Status;

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
        return 'ds.casestatus.status.widget.owner';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsCaseStatusBundle/Resources/views/Status/widget/owner.html.twig', $data);
    }
}
