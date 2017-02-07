<?php

namespace Ds\Bundle\AccountDashboardBundle\Widget\Portal\Home;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class LoginWidget
 */
class LoginWidget extends Widget
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
        return $this->templating->render('@DsAccountDashboardBundle/Resources/views/Portal/Home/widget/login.html.twig', $data);
    }
}
