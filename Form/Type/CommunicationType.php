<?php

namespace Ds\Bundle\CommunicationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CommunicationType
 */
class CommunicationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', [
            'label' => 'ds.communication.title.label'
        ]);

        $builder->add('description', 'textarea', [
            'label' => 'ds.communication.description.label',
            'required' => false
        ]);

        $builder->add('contents', 'oro_collection', [
            'label' => 'ds.communication.contents.label',
            'entry_type' => 'ds_communication_content',
            'allow_add' => true,
            'options' => [
                'communication' => false
            ]
        ]);

        $builder->add('criteria', 'oro_collection', [
            'label' => 'ds.communication.criterion.label',
            'entry_type' => 'ds_communication_criterion',
            'allow_add' => true,
            'options' => [
                'communication' => false
            ]
        ]);

        $builder->add('owner', 'oro_business_unit_select', [
            'label' => 'ds.communication.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\CommunicationBundle\Entity\Communication',
            'intention' => 'ds_communication_communication'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_communication_communication';
    }
}
