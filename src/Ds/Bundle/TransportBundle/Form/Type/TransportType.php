<?php

namespace Ds\Bundle\TransportBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ds\Bundle\TransportBundle\Collection\TransportCollection;

/**
 * Class TransportType
 */
class TransportType extends AbstractType
{
    /**
     * @var \Ds\Bundle\TransportBundle\Collection\TransportCollection
     */
    protected $transportCollection;

    /**
     * Constructor
     *
     * @param \Ds\Bundle\TransportBundle\Collection\TransportCollection $transportCollection
     */
    public function __construct(TransportCollection $transportCollection)
    {
        $this->transportCollection = $transportCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', [
            'label' => 'ds.transport.title.label'
        ]);

        $choices = [];

        foreach ($this->transportCollection as $item) {
            $choices[$item['implementation']] = 'ds.transport.collection.' . $item['implementation'];
        }

        $builder->add('implementation', 'choice', [
            'label' => 'ds.transport.implementation.label',
            'choices' => $choices
        ]);

        $builder->add(
            $builder
                ->create('data', 'textarea', [
                    'label' => 'ds.transport.data.label',
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
            'label' => 'ds.transport.profile.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\TransportBundle\Entity\Transport',
            'intention' => 'ds_transport_transport'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_transport_transport';
    }
}
