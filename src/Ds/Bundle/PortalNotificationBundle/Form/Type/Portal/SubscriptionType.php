<?php

namespace Ds\Bundle\PortalNotificationBundle\Form\Type\Portal;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SubscriptionType
 */
class SubscriptionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('user');

        $builder->remove('notification');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_portalnotification_portal_subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'ds_notification_subscription';
    }
}
