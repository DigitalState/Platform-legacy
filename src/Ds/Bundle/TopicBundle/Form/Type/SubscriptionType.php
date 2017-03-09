<?php

namespace Ds\Bundle\TopicBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

/**
 * Class SubscriptionType
 */
class SubscriptionType extends AbstractType
{
    /**
     * Build form
     *
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('user', 'oro_jqueryselect2_hidden', [
            'label' => 'ds.topic.subscription.user.label',
            'autocomplete_alias' => 'users',
            'configs' => [
                'component' => 'autocomplete',
                'placeholder' => 'ds.topic.subscription.user.placeholder',
                'allowClear' => true,
                'minimumInputLength' => 1,
                'route_name' => 'oro_form_autocomplete_search',
                'allowCreateNew' => true,
                'renderedPropertyName' => 'fullName'
            ]
        ]);

        $builder->add('topic', 'entity', [
            'label' => 'ds.topic.subscription.topic.label',
            'class' => 'DsTopicBundle:Topic',
            'choice_label' => 'defaultTitle',
            'placeholder' => 'ds.topic.subscription.topic.placeholder'
        ]);

        $builder->add('channels', 'entity', [
            'label' => 'ds.topic.subscription.channels.label',
            'class' => 'DsTopicBundle:Channel',
            'query_builder' => function(EntityRepository $repository) use ($options) {
                $query = $repository->createQueryBuilder('c');

                if ($options['topic']) {
                    $query
                        ->where('c.id IN (:channels)')
                        ->setParameter('channels', $options['topic']->getChannels());
                }

                return $query;
            },
            'property' => 'defaultTitle',
            'multiple' => true,
            'expanded' => true
        ]);

        $builder->add('owner', 'oro_business_unit_select', [
            'label' => 'ds.topic.subscription.owner.label'
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
            'data_class' => 'Ds\Bundle\TopicBundle\Entity\Subscription',
            'intention' => 'ds_topic_subscription',
            'topic' => null
        ]);
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return 'ds_topic_subscription';
    }
}
