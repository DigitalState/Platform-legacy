<?php

namespace Ds\Bundle\CaseStatusBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class StatusType
 */
class StatusType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('case', 'entity', [
            'label' => 'ds.casestatus.status.case.label',
            'class' => 'DsCaseBundle:CaseEntity',
            'placeholder' => 'ds.casestatus.status.case.placeholder',
            'choice_label' => 'defaultTitle'
        ]);

        $builder->add('titles', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.casestatus.status.title.label',
            'type' => 'text',
            'field' => 'text'
        ]);

        $builder->add('source', 'text', [
            'label' => 'ds.casestatus.status.source.label'
        ]);

        $builder->add('type', 'text', [
            'label' => 'ds.casestatus.status.type.label'
        ]);

        $builder->add('descriptions', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.casestatus.status.description.label',
            'type' => 'textarea',
            'field' => 'text',
            'required' => false
        ]);

        $builder->add('percentage', 'range', [
            'label' => 'ds.casestatus.status.percentage.label',
            'attr' => [
                'min' => 0,
                'max' => 100
            ]
        ]);

        $builder->add(
            $builder
                ->create('data', 'textarea', [
                    'label' => 'ds.casestatus.status.data.label',
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
            'label' => 'ds.casestatus.status.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\CaseStatusBundle\Entity\Status',
            'intention' => 'ds_casestatus_status'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_casestatus_status';
    }
}
