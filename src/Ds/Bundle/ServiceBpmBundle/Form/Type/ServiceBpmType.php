<?php

namespace Ds\Bundle\ServiceBpmBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ds\Bundle\BpmBundle\Collection\Bpm\ApiCollection;

/**
 * Class ServiceBpmType
 */
class ServiceBpmType extends AbstractType
{
    /**
     * @var \Ds\Bundle\BpmBundle\Collection\Bpm\ApiCollection
     */
    protected $apiCollection;

    /**
     * Constructor
     *
     * @param \Ds\Bundle\BpmBundle\Collection\Bpm\ApiCollection $apiCollection
     */
    public function __construct(ApiCollection $apiCollection)
    {
        $this->apiCollection = $apiCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = [];

        foreach ($this->apiCollection as $item) {
            $choices[$item['alias']] = 'ds.bpm.collection.' . $item['alias'];
        }

        $builder->add('bpm', 'choice', [
            'label' => 'ds.servicebpm.bpm.label',
            'choices' => $choices,
            'placeholder' => 'ds.servicebpm.bpm.placeholder'
        ]);

        $builder->add('bpmId', 'text', [
            'label' => 'ds.servicebpm.bpm_id.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\ServiceBpmBundle\Entity\ServiceBpm',
            'intention' => 'ds_servicebpm_servicebpm'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_servicebpm_servicebpm';
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'ds_service_service';
    }
}
