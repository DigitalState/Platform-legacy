<?php

namespace Ds\Bundle\AccountDashboardBundle\Widget\Account\Dashboard;

use Ds\Bundle\WidgetBundle\Widget\Widget;

/**
 * Class WelcomeWidget
 */
class WelcomeWidget extends Widget
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
        return $this->templating->render('@DsAccountDashboardBundle/Resources/views/Account/Dashboard/widget/welcome.html.twig', $data);
    }
}
