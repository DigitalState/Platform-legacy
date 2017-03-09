<?php

namespace Ds\Bundle\MessageBundle\Form\Type;

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
            'label' => 'ds.message.title.label'
        ]);

        $builder->add('presentation', 'textarea', [
            'label' => 'ds.message.presentation.label'
        ]);

        $builder->add('user', 'oro_jqueryselect2_hidden', [
            'label' => 'ds.message.user.label',
            'autocomplete_alias' => 'users',
            'configs' => [
                'component' => 'autocomplete',
                'placeholder' => 'ds.message.user.placeholder',
                'allowClear' => true,
                'minimumInputLength' => 1,
                'route_name' => 'oro_form_autocomplete_search',
                'allowCreateNew' => true,
                'renderedPropertyName' => 'fullName'
            ]
        ]);

        $builder->add('sentAt', 'oro_datetime', [
            'label' => 'ds.message.sent_at.label',
            'required' => false
        ]);

        $builder->add('owner', 'oro_business_unit_select', [
            'label' => 'ds.message.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\MessageBundle\Entity\Message',
            'intention' => 'ds_message_message'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_message_message';
    }
}
