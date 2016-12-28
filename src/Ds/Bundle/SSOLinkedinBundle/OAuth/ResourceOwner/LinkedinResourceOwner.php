<?php

namespace Ds\Bundle\SSOLinkedinBundle\OAuth\ResourceOwner;

use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\LinkedinResourceOwner as BaseLinkedinResourceOwner;
use Oro\Bundle\ConfigBundle\Config\ConfigManager;

/**
 * Class LinkedinResourceOwner
 */
class LinkedinResourceOwner extends BaseLinkedinResourceOwner
{
    /**
     * Configure credentials
     *
     * @param \Oro\Bundle\ConfigBundle\Config\ConfigManager $configManager
     */
    public function configureCredentials(ConfigManager $configManager)
    {
        $clientId = $configManager->get('ds_linkedin.client_id');

        if ($clientId) {
            $this->options['client_id'] = $clientId;
        }

        $clientSecret = $configManager->get('ds_linkedin.client_secret');

        if ($clientSecret) {
            $this->options['client_secret'] = $clientSecret;
        }
    }
}
