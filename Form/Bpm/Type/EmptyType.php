<?php

namespace Ds\Bundle\BpmBundle\Form\Bpm\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class EmptyType
 */
class EmptyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_bpm_bpm_empty';
    }
}
