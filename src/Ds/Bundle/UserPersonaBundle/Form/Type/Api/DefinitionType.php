<?php

namespace Ds\Bundle\UserPersonaBundle\Form\Type\Api;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Oro\Bundle\SoapBundle\Form\EventListener\PatchSubscriber;

/**
 * Class DefinitionType
 */
class DefinitionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventSubscriber(new PatchSubscriber);

        $builder->get('data')->resetModelTransformers();
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
        return 'ds_userpersona_api_definition';
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'ds_userpersona_definition';
    }
}
