<?php

namespace Ds\Bundle\CommunicationBundle\Criterion;

use Ds\Bundle\CommunicationBundle\Entity;
use Doctrine\ORM\QueryBuilder;

/**
 * Interface Criterion
 */
interface Criterion
{
    /**
     * Aggregate criterion to query builder
     *
     * @param \Doctrine\ORM\QueryBuilder $query
     * @param \Ds\Bundle\CommunicationBundle\Entity\Criterion $criterion
     * @param \Ds\Bundle\CommunicationBundle\Entity\Channel $channel
     * @return \Ds\Bundle\CommunicationBundle\Criterion\Criterion
     */
    public function aggregate(QueryBuilder $query, Entity\Criterion $criterion, Entity\Channel $channel = null);
}
