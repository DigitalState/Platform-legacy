<?php

namespace Ds\Bundle\CommunicationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TemplateType
 */
class TemplateType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', [
            'label' => 'ds.communication.template.title.label'
        ]);

        $builder->add('presentation', 'oro_rich_text', [
            'label' => 'ds.communication.template.presentation.label'
        ]);

        $builder->add('owner', 'oro_business_unit_select', [
            'label' => 'ds.communication.template.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\CommunicationBundle\Entity\Template',
            'intention' => 'ds_communication_template'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_communication_template';
    }
}
