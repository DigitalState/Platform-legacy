<?php

namespace Ds\Bundle\CommunicationBundle\Form\Type\Api;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Oro\Bundle\SoapBundle\Form\EventListener\PatchSubscriber;

/**
 * Class ChannelType
 */
class ChannelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventSubscriber(new PatchSubscriber);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_communication_api_channel';
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'ds_communication_channel';
    }
}
