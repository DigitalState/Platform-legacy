<?php

namespace Ds\Bundle\CommunicationBundle\Manager;

use Oro\Bundle\SoapBundle\Entity\Manager\ApiEntityManager;
use Doctrine\Common\Persistence\ObjectManager;
use Oro\Bundle\UserBundle\Entity\UserManager;
use Ds\Bundle\CommunicationBundle\Entity\Communication;
use Ds\Bundle\CommunicationBundle\Entity\Channel;
use Ds\Bundle\CommunicationBundle\Collection\CriterionCollection;

/**
 * Class CommunicationManager
 */
class CommunicationManager extends ApiEntityManager
{
    /**
     * @var \Oro\Bundle\UserBundle\Entity\UserManager
     */
    protected $userManager;

    /**
     * @var \Ds\Bundle\CommunicationBundle\Manager\MessageManager
     */
    protected $messageManager;

    /**
     * @var \Ds\Bundle\CommunicationBundle\Collection\CriterionCollection
     */
    protected $criterionCollection;

    /**
     * Constructor
     *
     * @param string $class
     * @param \Doctrine\Common\Persistence\ObjectManager $om
     * @param \Oro\Bundle\UserBundle\Entity\UserManager $userManager
     * @param \Ds\Bundle\CommunicationBundle\Manager\MessageManager $messageManager
     * @param \Ds\Bundle\CommunicationBundle\Collection\CriterionCollection $criterionCollection
     */
    public function __construct($class, ObjectManager $om, UserManager $userManager, MessageManager $messageManager, CriterionCollection $criterionCollection)
    {
        parent::__construct($class, $om);

        $this->userManager = $userManager;
        $this->messageManager = $messageManager;
        $this->criterionCollection = $criterionCollection;
    }

    /**
     * Send communication
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Communication $communication
     * @return \Ds\Bundle\CommunicationBundle\Manager\CommunicationManager
     */
    public function send(Communication $communication)
    {
        $contents = $communication->getContents();
        $criteria = $communication->getCriteria();

        foreach ($contents as $content) {
            $users = $this->getUsers($criteria, $content->getChannel());

            foreach ($users as $user) {
                $message = $this->messageManager->createEntity();
                $message
                    ->setCommunication($communication)
                    ->setUser($user)
                    ->setChannel($content->getChannel())
                    ->setTitle($content->getTitle())
                    ->setPresentation($content->getPresentation());
                $this->messageManager->send($message, $content->getProfile());
            }
        }

        return $this;
    }

    /**
     * Get users
     *
     * @param array $criteria
     * @param \Ds\Bundle\CommunicationBundle\Entity\Channel $channel
     * @return array
     */
    public function getUsers(array $criteria, Channel $channel = null)
    {
        if (!$criteria) {
            return [];
        }

        $query = $this->om->createQueryBuilder();
        $query
            ->select([ 'u' ])
            ->from('\\Oro\\Bundle\\UserBundle\\Entity\\User', 'u');

        foreach ($criteria as $criterion) {
            $definition = $this->criterionCollection->filter(function($item) use ($criterion) {
                return $item['implementation'] == $criterion->getImplementation();
            })->first()['criterion'];

            $definition->aggregate($query, $criterion, $channel);
        }

        return $query->getQuery()->getResult();
    }
}
