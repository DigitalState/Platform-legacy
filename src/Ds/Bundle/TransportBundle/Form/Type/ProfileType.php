<?php

namespace Ds\Bundle\TransportBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ProfileType
 */
class ProfileType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', [
            'label' => 'ds.transport.profile.title.label'
        ]);

        $builder->add('transport', 'entity', [
            'label' => 'ds.transport.profile.transport.label',
            'class' => 'DsTransportBundle:Transport',
            'choice_label' => 'title'
        ]);

        $builder->add(
            $builder
                ->create('data', 'textarea', [
                    'label' => 'ds.transport.profile.data.label',
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
            'label' => 'ds.transport.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\TransportBundle\Entity\Profile',
            'intention' => 'ds_transport_profile'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_transport_profile';
    }
}
