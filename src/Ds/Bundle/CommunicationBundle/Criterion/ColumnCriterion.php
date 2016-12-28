<?php

namespace Ds\Bundle\CommunicationBundle\Criterion;

use Ds\Bundle\CommunicationBundle\Entity;
use Doctrine\ORM\QueryBuilder;

/**
 * Class ColumnCriterion
 */
class ColumnCriterion implements Criterion
{
    /**
     * {@inheritdoc}
     */
    public function aggregate(QueryBuilder $query, Entity\Criterion $criterion, Entity\Channel $channel = null)
    {
        return $this;
    }
}
