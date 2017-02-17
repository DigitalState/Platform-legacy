<?php

namespace Ds\Bundle\UserPersonaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PersonaType
 */
class PersonaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('user', 'oro_jqueryselect2_hidden', [
            'label' => 'ds.userpersona.persona.user.label',
            'autocomplete_alias' => 'users',
            'configs' => [
                'component' => 'autocomplete',
                'placeholder' => 'ds.userpersona.persona.user.placeholder',
                'allowClear' => true,
                'minimumInputLength' => 1,
                'route_name' => 'oro_form_autocomplete_search',
                'allowCreateNew' => true,
                'renderedPropertyName' => 'fullName'
            ]
        ]);

        $builder->add('definition', 'entity', [
            'label' => 'ds.userpersona.persona.definition.label',
            'class' => 'DsUserPersonaBundle:Definition',
            'choice_label' => 'title',
            'placeholder' => 'ds.userpersona.persona.definition.placeholder',
        ]);

        $builder->add(
            $builder
                ->create('data', 'textarea', [
                    'label' => 'ds.userpersona.persona.data.label',
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
            'label' => 'ds.userpersona.persona.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\UserPersonaBundle\Entity\Persona',
            'intention' => 'ds_userpersona_persona'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_userpersona_persona';
    }
}
