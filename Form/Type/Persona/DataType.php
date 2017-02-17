<?php

namespace Ds\Bundle\UserPersonaBundle\Form\Type\Persona;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class DataType
 */
class DataType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (!$options['persona']) {
            return;
        }

        foreach ($options['persona']->getData() as $property => $value) {
            $builder->add($property, 'text', [
                'required' => false
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'persona' => null
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_userpersona_persona_data';
    }
}
