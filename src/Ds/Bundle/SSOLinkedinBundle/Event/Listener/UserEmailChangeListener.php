<?php

namespace Ds\Bundle\SSOLinkedinBundle\Event\Listener;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Oro\Bundle\UserBundle\Entity\User;

/**
 * Class UserEmailChangeListener
 */
class UserEmailChangeListener
{
    /**
     * Pre update callback
     *
     * @param \Doctrine\ORM\Event\PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        if (!$args->getEntity() instanceof User || !$args->hasChangedField('email')) {
            return;
        }

        $args->getEntity()->setLinkedinId(null);
    }
}
