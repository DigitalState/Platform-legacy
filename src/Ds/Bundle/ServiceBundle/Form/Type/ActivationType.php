<?php

namespace Ds\Bundle\ServiceBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ActivationType
 */
class ActivationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('service', 'entity', [
            'label' => 'ds.service.activation.service.label',
            'class' => 'DsServiceBundle:Service',
            'choice_label' => 'defaultTitle',
            'placeholder' => 'ds.service.activation.service.placeholder'
        ]);

        $builder->add('user', 'oro_jqueryselect2_hidden', [
            'label' => 'ds.service.activation.user.label',
            'autocomplete_alias' => 'users',
            'configs' => [
                'component' => 'autocomplete',
                'placeholder' => 'ds.service.activation.user.placeholder',
                'allowClear' => true,
                'minimumInputLength' => 1,
                'route_name' => 'oro_form_autocomplete_search',
                'allowCreateNew' => true,
                'renderedPropertyName' => 'fullName'
            ]
        ]);

        $builder->add('owner', 'oro_business_unit_select', [
            'label' => 'ds.service.activation.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\ServiceBundle\Entity\Activation',
            'intention' => 'ds_service_activation'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_service_activation';
    }
}
