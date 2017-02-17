<?php

namespace Ds\Bundle\SSOTwitterBundle\OAuth\ResourceOwner;

use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\TwitterResourceOwner as BaseTwitterResourceOwner;
use Oro\Bundle\ConfigBundle\Config\ConfigManager;

/**
 * Class TwitterResourceOwner
 */
class TwitterResourceOwner extends BaseTwitterResourceOwner
{
    /**
     * Configure credentials
     *
     * @param \Oro\Bundle\ConfigBundle\Config\ConfigManager $configManager
     */
    public function configureCredentials(ConfigManager $configManager)
    {
        $clientId = $configManager->get('ds_twitter.client_id');

        if ($clientId) {
            $this->options['client_id'] = $clientId;
        }

        $clientSecret = $configManager->get('ds_twitter.client_secret');

        if ($clientSecret) {
            $this->options['client_secret'] = $clientSecret;
        }
    }
}
