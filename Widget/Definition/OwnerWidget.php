<?php

namespace Ds\Bundle\UserPersonaBundle\Widget\Definition;

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
        return 'ds.userpersona.definition.widget.owner';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsUserPersonaBundle/Resources/views/Definition/widget/owner.html.twig', $data);
    }
}
