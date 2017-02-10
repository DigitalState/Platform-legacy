<?php

namespace Ds\Bundle\CaseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CaseType
 */
class CaseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titles', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.case.caseentity.title.label',
            'type' => 'text',
            'field' => 'text'
        ]);

        $builder->add('source', 'text', [
            'label' => 'ds.case.caseentity.source.label'
        ]);

        $builder->add('state', 'choice', [
            'label' => 'ds.case.caseentity.state.label',
            'placeholder' => 'ds.case.caseentity.state.placeholder',
            'choices' => [
                'active' => 'ds.case.caseentity.state.choice.active',
                'inactive' => 'ds.case.caseentity.state.choice.inactive'
            ],
            'expanded' => true,
            'data' => 'active'
        ]);

        $builder->add('status', 'choice', [
            'label' => 'ds.case.caseentity.status.label',
            'placeholder' => 'ds.case.caseentity.status.placeholder',
            'choices' => [
                'active' => 'ds.case.caseentity.status.choice.active',
                'resolved' => 'ds.case.caseentity.status.choice.resolved',
                'cancelled' => 'ds.case.caseentity.status.choice.cancelled'
            ],
            'expanded' => true,
            'data' => 'active'
        ]);

        $builder->add('user', 'oro_jqueryselect2_hidden', [
            'label' => 'ds.case.caseentity.user.label',
            'autocomplete_alias' => 'users',
            'configs' => [
                'component' => 'autocomplete',
                'placeholder' => 'ds.case.caseentity.user.placeholder',
                'allowClear' => true,
                'minimumInputLength' => 1,
                'route_name' => 'oro_form_autocomplete_search',
                'allowCreateNew' => true,
                'renderedPropertyName' => 'fullName'
            ]
        ]);

        $builder->add('service', 'entity', [
            'label' => 'ds.case.caseentity.service.label',
            'class' => 'DsServiceBundle:Service',
            'choice_label' => 'defaultTitle',
            'placeholder' => 'ds.case.caseentity.service.placeholder',
            'required' => false
        ]);

        $builder->add('owner', 'oro_business_unit_select', [
            'label' => 'ds.case.caseentity.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\CaseBundle\Entity\CaseEntity',
            'intention' => 'ds_case_case'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_case_case';
    }
}
