<?php

namespace Ds\Bundle\TopicBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TopicType
 */
class TopicType extends AbstractType
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
            'label' => 'ds.topic.title.label',
            'type' => 'text',
            'field' => 'text'
        ]);

        $builder->add('slug', 'text', [
            'label' => 'ds.topic.slug.label'
        ]);

        $builder->add('descriptions', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.topic.description.label',
            'type' => 'textarea',
            'field' => 'text',
            'required' => false
        ]);

        $builder->add('icon', 'text', [
            'label' => 'ds.topic.icon.label'
        ]);

        $builder->add('presentations', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.topic.presentation.label',
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
            'label' => 'ds.topic.owner.label'
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
            'data_class' => 'Ds\Bundle\TopicBundle\Entity\Topic',
            'intention' => 'ds_topic_topic'
        ]);
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return 'ds_topic_topic';
    }
}
