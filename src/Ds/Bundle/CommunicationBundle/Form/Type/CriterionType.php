<?php

namespace Ds\Bundle\CommunicationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ds\Bundle\CommunicationBundle\Collection\CriterionCollection;

/**
 * Class CriterionType
 */
class CriterionType extends AbstractType
{
    /**
     * @var \Ds\Bundle\CommunicationBundle\Collection\CriterionCollection
     */
    protected $criterionCollection;

    /**
     * Constructor
     *
     * @param \Ds\Bundle\CommunicationBundle\Collection\CriterionCollection $criterionCollection
     */
    public function __construct(CriterionCollection $criterionCollection)
    {
        $this->criterionCollection = $criterionCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['communication']) {
            $builder->add('communication', 'entity', [
                'label' => 'ds.communication.criterion.communication.label',
                'class' => 'DsCommunicationBundle:Communication',
                'choice_label' => 'title',
                'placeholder' => 'ds.communication.criterion.communication.placeholder'
            ]);
        }

        $choices = [];

        foreach ($this->criterionCollection as $item) {
            $choices[$item['implementation']] = 'ds.communication.criterion.collection.' . $item['implementation'];
        }

        $builder->add('implementation', 'choice', [
            'label' => 'ds.communication.criterion.implementation.label',
            'choices' => $choices
        ]);

        $builder->add('operand1', 'text', [
            'label' => 'ds.communication.criterion.operand_1.label'
        ]);

        $builder->add('operator', 'choice', [
            'label' => 'ds.communication.criterion.operator.label',
            'choices' => [
                '=' => '=',
                '>' => '>',
                '>=' => '>=',
                '<' => '<',
                '<=' => '<='
            ]
        ]);

        $builder->add('operand2', 'text', [
            'label' => 'ds.communication.criterion.operand_2.label'
        ]);

        $builder->add('owner', 'oro_business_unit_select', [
            'label' => 'ds.communication.criterion.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\CommunicationBundle\Entity\Criterion',
            'intention' => 'ds_communication_criterion',
            'communication' => true
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_communication_criterion';
    }
}
