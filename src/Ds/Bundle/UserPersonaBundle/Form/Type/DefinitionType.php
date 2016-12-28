<?php

namespace Ds\Bundle\UserPersonaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
        $builder->add('title', 'text', [
            'label' => 'ds.userpersona.definition.title.label'
        ]);

        $builder->add('slug', 'text', [
            'label' => 'ds.userpersona.definition.slug.label'
        ]);

        $builder->add(
            $builder
                ->create('data', 'textarea', [
                    'label' => 'ds.userpersona.definition.data.label',
                    'required' => false
                ])
                ->addModelTransformer(new CallbackTransformer(
                    function($data) {
                        return json_encode($data);
                    },
                    function($data) {
                        return json_decode($data);
                    }
                ))
        );

        $builder->add('owner', 'oro_business_unit_select', [
            'label' => 'ds.userpersona.definition.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\UserPersonaBundle\Entity\Definition',
            'intention' => 'ds_userpersona_definition'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_userpersona_definition';
    }
}
