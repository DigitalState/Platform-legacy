<?php

namespace Ds\Bundle\NotificationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class NotificationType
 */
class NotificationType extends AbstractType
{
    /**
     * Build form
     *
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titles', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.notification.title.label',
            'type' => 'text',
            'field' => 'text'
        ]);

        $builder->add('slug', 'text', [
            'label' => 'ds.notification.slug.label'
        ]);

        $builder->add('descriptions', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.notification.description.label',
            'type' => 'textarea',
            'field' => 'text',
            'required' => false
        ]);

        $builder->add('icon', 'text', [
            'label' => 'ds.notification.icon.label'
        ]);

        $builder->add('presentations', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.notification.presentation.label',
            'type' => 'oro_rich_text',
            'field' => 'text',
            'required' => false
        ]);

        $builder->add('channels', 'entity', [
            'class' => 'DsCommunicationBundle:Channel',
            'choice_label' => 'defaultTitle',
            'multiple' => true,
            'expanded' => true
        ]);

        $builder->add('owner', 'oro_business_unit_select', [
            'label' => 'ds.notification.owner.label'
        ]);
    }

    /**
     * Configure options
     *
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\NotificationBundle\Entity\Notification',
            'intention' => 'ds_notification_notification'
        ]);
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return 'ds_notification_notification';
    }
}
