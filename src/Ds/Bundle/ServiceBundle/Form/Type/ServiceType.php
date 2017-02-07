<?php

namespace Ds\Bundle\ServiceBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ServiceType
 */
class ServiceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titles', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.service.title.label',
            'type' => 'text',
            'field' => 'text'
        ]);

        $builder->add('slug', 'text', [
            'label' => 'ds.service.slug.label'
        ]);

        $builder->add('descriptions', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.service.description.label',
            'type' => 'textarea',
            'field' => 'text',
            'required' => false
        ]);

        $builder->add('icon', 'text', [
            'label' => 'ds.service.icon.label'
        ]);

        $builder->add('buttons', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.service.button.label',
            'type' => 'text',
            'field' => 'text'
        ]);

        $builder->add('presentations', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.service.presentation.label',
            'type' => 'oro_rich_text',
            'field' => 'text',
            'required' => false
        ]);

        $builder->add('owner', 'oro_business_unit_select', [
            'label' => 'ds.service.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\ServiceBundle\Entity\Service',
            'intention' => 'ds_service_service'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_service_service';
    }
}
