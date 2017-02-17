<?php

namespace Ds\Bundle\UserPersonaBundle\Widget\Persona;

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
        return 'ds.userpersona.persona.widget.owner';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsUserPersonaBundle/Resources/views/Persona/widget/owner.html.twig', $data);
    }
}
