<?php

namespace Ds\Bundle\NotificationBundle\Form\Type;

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
            'label' => 'ds.notification.subscription.user.label',
            'autocomplete_alias' => 'users',
            'configs' => [
                'component' => 'autocomplete',
                'placeholder' => 'ds.notification.subscription.user.placeholder',
                'allowClear' => true,
                'minimumInputLength' => 1,
                'route_name' => 'oro_form_autocomplete_search',
                'allowCreateNew' => true,
                'renderedPropertyName' => 'fullName'
            ]
        ]);

        $builder->add('notification', 'entity', [
            'label' => 'ds.notification.subscription.notification.label',
            'class' => 'DsNotificationBundle:Notification',
            'choice_label' => 'defaultTitle',
            'placeholder' => 'ds.notification.subscription.notification.placeholder'
        ]);

        $builder->add('channels', 'entity', [
            'label' => 'ds.notification.subscription.channels.label',
            'class' => 'DsCommunicationBundle:Channel',
            'query_builder' => function(EntityRepository $repository) use ($options) {
                $query = $repository->createQueryBuilder('c');

                if ($options['notification']) {
                    $query
                        ->where('c.id IN (:channels)')
                        ->setParameter('channels', $options['notification']->getChannels());
                }

                return $query;
            },
            'property' => 'defaultTitle',
            'multiple' => true,
            'expanded' => true
        ]);

        $builder->add('owner', 'oro_business_unit_select', [
            'label' => 'ds.notification.subscription.owner.label'
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
            'data_class' => 'Ds\Bundle\NotificationBundle\Entity\Subscription',
            'intention' => 'ds_notification_subscription',
            'notification' => null
        ]);
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return 'ds_notification_subscription';
    }
}
