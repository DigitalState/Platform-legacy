<?php

namespace Ds\Bundle\ServiceUrlBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ServiceUrlType
 */
class ServiceUrlType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('urls', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.serviceurl.url.label',
            'type' => 'text',
            'field' => 'text'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\ServiceUrlBundle\Entity\ServiceUrl',
            'intention' => 'ds_serviceurl_serviceurl'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_serviceurl_serviceurl';
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'ds_service_service';
    }
}
