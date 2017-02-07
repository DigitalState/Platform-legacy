<?php

namespace Ds\Bundle\AssetBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AssetType
 */
class AssetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titles', 'oro_locale_localized_fallback_value_collection', [
            'label' => 'ds.asset.title.label',
            'type' => 'text',
            'field' => 'text'
        ]);

        $builder->add('type', 'text', [
            'label' => 'ds.asset.type.label'
        ]);

        $builder->add('source', 'text', [
            'label' => 'ds.asset.source.label'
        ]);

        $builder->add(
            $builder
                ->create('data', 'textarea', [
                    'label' => 'ds.asset.data.label',
                    'required' => false
                ])
                ->addModelTransformer(new CallbackTransformer(
                    function($data) {
                        return json_encode($data);
                    },
                    function($data) {
                        return json_decode($data);
                    }
                ))
        );

        $builder->add('user', 'oro_jqueryselect2_hidden', [
            'label' => 'ds.asset.user.label',
            'autocomplete_alias' => 'users',
            'configs' => [
                'component' => 'autocomplete',
                'placeholder' => 'ds.asset.user.placeholder',
                'allowClear' => true,
                'minimumInputLength' => 1,
                'route_name' => 'oro_form_autocomplete_search',
                'allowCreateNew' => true,
                'renderedPropertyName' => 'fullName'
            ]
        ]);

        $builder->add('case', 'entity', [
            'label' => 'ds.asset.case.label',
            'class' => 'DsCaseBundle:CaseEntity',
            'choice_label' => 'defaultTitle',
            'placeholder' => 'ds.asset.case.placeholder'
        ]);

        $builder->add('owner', 'oro_business_unit_select', [
            'label' => 'ds.asset.owner.label'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ds\Bundle\AssetBundle\Entity\Asset',
            'intention' => 'ds_asset_asset'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_asset_asset';
    }
}
