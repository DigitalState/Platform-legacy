<?php

namespace Ds\Bundle\CommunicationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ContentType
 */
class ContentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['communication']) {
            $builder->add('communication', 'entity', [
                'label' => 'ds.communication.content.communication.label',
                'class' => 'DsCommunicationBundle:Communication',
                'choice_label' => 'title',
                'placeholder' => 'ds.communication.content.communication.placeholder'
            ]);
        }

        $builder->add('channel', 'entity', [
            'label' => 'ds.communication.content.channel.label',
            'class' => 'DsCommunicationBundle:Channel',
            'choice_label' => 'defaultTitle',
            'placeholder' => 'ds.communication.content.channel.placeholder'
        ]);

        $builder->add('profile', 'entity', [
            'label' => 'ds.communication.content.profile.label',
            'class' => 'DsTransportBundle:Profile',
            'choice_label' => 'title',
            'placeholder' => 'ds.communication.content.profile.placeholder'
        ]);

        $builder->add('title', 'text', [
            'label' => 'ds.communication.content.title.label'
        ]);

        $builder->add('template', 'entity', [
            'label' => 'ds.communication.content.template.label',
            'class' => 'DsCommunicationBundle:Template',
            'choice_label' => 'title',
            'placeholder' => 'ds.communication.content.template.placeholder'
        ]);

        $builder->add('presentation', 'oro_rich_text', [
            'label' => 'ds.communication.content.presentation.label'
        ]);

        $builder->add('owner', 'oro_business_unit_select', [
            'label' => 'ds.communication.content.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\CommunicationBundle\Entity\Content',
            'intention' => 'ds_communication_content',
            'communication' => true
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_communication_content';
    }
}
