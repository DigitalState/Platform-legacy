<?php

namespace Ds\Bundle\CommunicationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class MessageType
 */
class MessageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', [
            'label' => 'ds.communication.message.title.label'
        ]);

        $builder->add('presentation', 'textarea', [
            'label' => 'ds.communication.message.presentation.label'
        ]);

        $builder->add('communication', 'entity', [
            'label' => 'ds.communication.message.communication.label',
            'class' => 'DsCommunicationBundle:Communication',
            'choice_label' => 'title',
            'placeholder' => 'ds.communication.message.communication.placeholder'
        ]);

        $builder->add('user', 'oro_jqueryselect2_hidden', [
            'label' => 'ds.communication.message.user.label',
            'autocomplete_alias' => 'users',
            'configs' => [
                'component' => 'autocomplete',
                'placeholder' => 'ds.communication.message.user.placeholder',
                'allowClear' => true,
                'minimumInputLength' => 1,
                'route_name' => 'oro_form_autocomplete_search',
                'allowCreateNew' => true,
                'renderedPropertyName' => 'fullName'
            ]
        ]);

        $builder->add('channel', 'entity', [
            'label' => 'ds.communication.message.channel.label',
            'class' => 'DsCommunicationBundle:Channel',
            'choice_label' => 'defaultTitle',
            'placeholder' => 'ds.communication.message.channel.placeholder'
        ]);

        $builder->add('sentAt', 'oro_datetime', [
            'label' => 'ds.communication.message.sent_at.label',
            'required' => false
        ]);

        $builder->add('owner', 'oro_business_unit_select', [
            'label' => 'ds.communication.message.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\CommunicationBundle\Entity\Message',
            'intention' => 'ds_communication_message'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_communication_message';
    }
}
