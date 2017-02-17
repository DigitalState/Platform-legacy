<?php

namespace Ds\Bundle\PortalBundle\Widget\Portal;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class CopyrightWidget
 */
class CopyrightWidget extends Widget
{
    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function getContent(array $data = [])
    {
        return $this->templating->render('@DsPortalBundle/Resources/views/Portal/widget/copyright.html.twig', $data);
    }
}
