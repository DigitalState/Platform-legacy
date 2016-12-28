<?php

namespace Ds\Bundle\NotificationBundle\Criterion;

use Ds\Bundle\CommunicationBundle\Criterion\Criterion;
use Doctrine\ORM\EntityManager;
use Ds\Bundle\CommunicationBundle\Entity;
use Doctrine\ORM\QueryBuilder;

/**
 * Class NotificationCriterion
 */
class NotificationCriterion implements Criterion
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function aggregate(QueryBuilder $query, Entity\Criterion $criterion, Entity\Channel $channel = null)
    {
        // @todo use query builder with join/subquery
//        $subQuery = $this->entityManager->createQueryBuilder();
//        $subQuery
//            ->select([ 's.user' ])
//            ->from('\\Ds\\Bundle\\NotificationBundle\\Entity\\Subscription', 's');

        $statement = $this->entityManager->getConnection()->prepare('
                      SELECT
                          `ns`.`user_id`
                      FROM
                          `ds_notification_subscription` `ns`
                      INNER JOIN
                          `ds_notification_subscription_channel` `nsc` ON `nsc`.`subscription_id` = `ns`.`id`' . ($channel ? ' AND `nsc`.`channel_id` = :channel' : '') . '
                      WHERE
                          `ns`.`notification_id` = :notification'
        );

        $parameters = [ 'notification' => $criterion->getOperand2() ];

        if ($channel) {
            $parameters['channel'] = $channel->getId();
        }

        $statement->execute($parameters);

        $users = array_map(function($item) {
            return $item['user_id'];
        }, $statement->fetchAll());

        $query->andWhere($query->expr()->in('u.id', $users ?: [ '' ]));

        return $this;
    }
}
