<?php

namespace Ds\Bundle\TopicBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ChannelType
 */
class ChannelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titles', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.topic.channel.title.label',
            'type' => 'text',
            'field' => 'text'
        ]);

        $builder->add('descriptions', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.topic.channel.description.label',
            'type' => 'textarea',
            'field' => 'text',
            'required' => false
        ]);

        $builder->add('icon', 'text', [
            'label' => 'ds.topic.channel.icon.label'
        ]);

        $builder->add('defaultTo', 'text', [
            'label' => 'ds.topic.channel.default_to.label'
        ]);

        $builder->add('owner', 'oro_business_unit_select', [
            'label' => 'ds.topic.channel.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\TopicBundle\Entity\Channel',
            'intention' => 'ds_topic_channel'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_topic_channel';
    }
}
