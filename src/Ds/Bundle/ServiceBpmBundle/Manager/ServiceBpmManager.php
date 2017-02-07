<?php

namespace Ds\Bundle\ServiceBpmBundle\Manager;

use Ds\Bundle\ServiceBundle\Manager\ServiceManager;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Bundle\ServiceBundle\Manager\ActivationManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Ds\Bundle\ServiceBundle\Entity\Service;
use Oro\Bundle\UserBundle\Entity\User;
use Ds\Bundle\ServiceBpmBundle\Entity\ServiceBpm;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use InvalidArgumentException;

/**
 * Class ServiceBpmManager
 */
class ServiceBpmManager extends ServiceManager
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Routing\Router
     */
    protected $router;

    /**
     * Constructor
     *
     * @param string $class
     * @param \Doctrine\Common\Persistence\ObjectManager $om Object manager
     * @param \Ds\Bundle\ServiceBundle\Manager\ActivationManager $activation
     * @param \Symfony\Bundle\FrameworkBundle\Routing\Router $router
     */
    public function __construct($class, ObjectManager $om, ActivationManager $activation, Router $router)
    {
        parent::__construct($class, $om, $activation);

        $this->router = $router;
    }

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
        if (!$service instanceof ServiceBpm) {
            throw new InvalidArgumentException();
        }

        parent::activate($service, $user);

        return $this->router->generate('ds_accountbpm_account_process_start', [ 'id' => $service->getId() ], UrlGeneratorInterface::ABSOLUTE_PATH);
    }
}
