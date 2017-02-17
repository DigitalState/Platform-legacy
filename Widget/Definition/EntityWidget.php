<?php

namespace Ds\Bundle\UserPersonaBundle\Widget\Definition;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class EntityWidget
 */
class EntityWidget extends Widget
{
    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return 'ds.userpersona.definition.widget.entity';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsUserPersonaBundle/Resources/views/Definition/widget/entity.html.twig', $data);
    }
}
