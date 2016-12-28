<?php

namespace Ds\Bundle\DataBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ds\Bundle\DataBundle\Data\Data;

/**
 * Class DataTypeExtension
 */
class DataTypeExtension extends AbstractTypeExtension
{
    /**
     * @var \Ds\Bundle\DataBundle\Data\Data
     */
    protected $data;

    /**
     * Construct
     *
     * @param \Ds\Bundle\DataBundle\Data\Data $data
     */
    public function __construct(Data $data)
    {
        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (!$options['resolve']) {
            return;
        }

        $variable = $builder->getData();
        $value = $this->data->get($variable);
        $builder->setData($value);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'resolve' => false
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'form';
    }
}
