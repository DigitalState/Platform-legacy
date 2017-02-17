<?php

namespace Ds\Bundle\AccountBundle\Widget\Account\Menu;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class MainWidget
 */
class MainWidget extends Widget
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
        return $this->templating->render('@DsAccountBundle/Resources/views/Account/widget/menu/main.html.twig', $data);
    }
}
