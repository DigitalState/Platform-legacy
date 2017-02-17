<?php

namespace Ds\Bundle\UserPersonaBundle\Widget\Persona;

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
        return 'ds.userpersona.persona.widget.entity';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsUserPersonaBundle/Resources/views/Persona/widget/entity.html.twig', $data);
    }
}
