<?php

namespace Ds\Bundle\ServiceBundle\Manager;

use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Bundle\ServiceBundle\Entity\Service;
use Oro\Bundle\UserBundle\Entity\User;

/**
 * Class ServiceManager
 */
class ServiceManager extends ApiEntityManager
{
    /**
     * @var \Ds\Bundle\ServiceBundle\Manager\ActivationManager
     */
    protected $activationManager;

    /**
     * Constructor
     *
     * @param string $class
     * @param \Doctrine\Common\Persistence\ObjectManager $om
     * @param \Ds\Bundle\ServiceBundle\Manager\ActivationManager $activationManager
     */
    public function __construct($class, ObjectManager $om, ActivationManager $activationManager)
    {
        parent::__construct($class, $om);

        $this->activationManager = $activationManager;
    }

    /**
     * Activate service
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Service $service
     * @param \Oro\Bundle\UserBundle\Entity\User $user
     * @return \Ds\Bundle\ServiceBundle\Entity\Activation
     */
    public function activate(Service $service, User $user)
    {
        $activation = $this->activationManager->createEntity();
        $activation
            ->setService($service)
            ->setUser($user)
            ->setOwner($service->getOwner());
        $om = $this->activationManager->getObjectManager();
        $om->persist($activation);
        $om->flush();

        return null;
    }
}
