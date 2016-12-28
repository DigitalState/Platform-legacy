<?php

namespace Ds\Bundle\UserPersonaBundle\Widget\Persona;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class FormWidget
 */
class FormWidget extends Widget
{
    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return 'ds.userpersona.persona.widget.form';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsUserPersonaBundle/Resources/views/Persona/widget/form.html.twig', $data);
    }
}
