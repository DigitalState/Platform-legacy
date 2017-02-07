<?php

namespace Ds\Bundle\RecordBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RecordType
 */
class RecordType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titles', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.record.title.label',
            'type' => 'text',
            'field' => 'text'
        ]);

        $builder->add('type', 'text', [
            'label' => 'ds.record.type.label'
        ]);

        $builder->add('source', 'text', [
            'label' => 'ds.record.source.label'
        ]);

        $builder->add(
            $builder
                ->create('data', 'textarea', [
                    'label' => 'ds.record.data.label',
                    'required' => false
                ])
                ->addModelTransformer(new CallbackTransformer(
                    function ($data) {
                        return json_encode($data);
                    },
                    function ($data) {
                        return json_decode($data);
                    }
                ))
        );

        $builder->add('case', 'entity', [
            'label' => 'ds.record.case.label',
            'class' => 'DsCaseBundle:CaseEntity',
            'choice_label' => 'defaultTitle',
            'placeholder' => 'ds.record.case.placeholder'
        ]);

        $builder->add('owner', 'oro_business_unit_select', [
            'label' => 'ds.record.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\RecordBundle\Entity\Record',
            'intention' => 'ds_record_record'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_record_record';
    }
}
