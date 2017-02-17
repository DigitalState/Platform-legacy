<?php

namespace Ds\Bundle\CommunicationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ds\Bundle\CommunicationBundle\Collection\ChannelCollection;

/**
 * Class ChannelType
 */
class ChannelType extends AbstractType
{
    /**
     * @var \Ds\Bundle\CommunicationBundle\Collection\ChannelCollection
     */
    protected $channelCollection;

    /**
     * Constructor
     *
     * @param \Ds\Bundle\CommunicationBundle\Collection\ChannelCollection $channelCollection
     */
    public function __construct(ChannelCollection $channelCollection)
    {
        $this->channelCollection = $channelCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titles', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.communication.channel.title.label',
            'type' => 'text',
            'field' => 'text'
        ]);

        $builder->add('descriptions', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.communication.channel.description.label',
            'type' => 'textarea',
            'field' => 'text',
            'required' => false
        ]);

        $builder->add('icon', 'text', [
            'label' => 'ds.communication.channel.icon.label'
        ]);

        $choices = [];

        foreach ($this->channelCollection as $item) {
            $choices[$item['implementation']] = 'ds.communication.channel.collection.' . $item['implementation'];
        }

        $builder->add('implementation', 'choice', [
            'label' => 'ds.communication.channel.implementation.label',
            'choices' => $choices
        ]);

        $builder->add('defaultTo', 'text', [
            'label' => 'ds.communication.channel.default_to.label'
        ]);

        $builder->add('owner', 'oro_business_unit_select', [
            'label' => 'ds.communication.channel.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\CommunicationBundle\Entity\Channel',
            'intention' => 'ds_communication_channel'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_communication_channel';
    }
}
