<?php

namespace Ds\Bundle\ServiceUrlBundle\Manager;

use Ds\Bundle\ServiceBundle\Manager\ServiceManager;
use Ds\Bundle\ServiceBundle\Entity\Service;
use Oro\Bundle\UserBundle\Entity\User;
use Ds\Bundle\ServiceUrlBundle\Entity\ServiceUrl;
use InvalidArgumentException;

/**
 * Class ServiceUrlManager
 */
class ServiceUrlManager extends ServiceManager
{
    /**
     * Activate service
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Service $service
     * @param \Oro\Bundle\UserBundle\Entity\User $user
     * @return string
     * @throws \InvalidArgumentException
     */
    public function activate(Service $service, User $user)
    {
        if (!$service instanceof ServiceUrl) {
            throw new InvalidArgumentException();
        }

        parent::activate($service, $user);

        return $service->getUrl();
    }
}
