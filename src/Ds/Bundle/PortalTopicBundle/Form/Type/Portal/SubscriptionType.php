<?php

namespace Ds\Bundle\PortalTopicBundle\Form\Type\Portal;

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

        $builder->remove('topic');
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
        return 'ds_portaltopic_portal_subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'ds_topic_subscription';
    }
}
