<?php

namespace Ds\Bundle\AdminBundle\Controller;

use Ds\Bundle\EntityBundle\Controller\EntityController;

/**
 * Class BreadController
 */
class BreadController extends EntityController
{
    /**
     * Handle index
     *
     * @return array
     */
    protected function handleIndex()
    {
        $config = $this->getConfigByAlias('grid', '');

        return [
            'gridName' => $config->get('default')
        ];
    }

    /**
     * Handle view
     *
     * @param object $entity
     * @return array
     */
    protected function handleView($entity)
    {
        $config = $this->getConfig('entity', $entity);

        return [
            'entity' => $entity,
            'context' => $config->get('alias') ?: null
        ];
    }

    /**
     * Handle create
     *
     * @param string $alias
     * @return array
     */
    protected function handleCreate($alias)
    {
        $config = $this->getConfigByAlias('manager', $alias);
        $manager = $config->get('default');

        if (!$manager) {
            $config = $this->getConfigByAlias('manager', '');
            $manager = $config->get('default');
        }

        $manager = $this->get($manager);
        $entity = $manager->createEntity();

        return $this->handleForm($entity);
    }

    /**
     * handle edit
     *
     * @param object $entity
     * @return array
     */
    protected function handleEdit($entity)
    {
        return $this->handleForm($entity);
    }

    /**
     * Handle form
     *
     * @param object $entity
     * @return array
     */
    protected function handleForm($entity)
    {
        $request = $this->get('request');
        $config = $this->getConfig('form', $entity);
        $form = $config->get('form_type');

        if (!$form) {
            $config = $this->getConfigByAlias('form', '');
            $form = $config->get('form_type');
        }

        $form = $this->createForm($form, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $form->getData();
            $config = $this->getConfig('manager', $entity);
            $manager = $this->get($config->get('default'));
            $om = $manager->getObjectManager();
            $om->persist($entity);
            $om->flush();
            $meta = $this->getMetaByAlias('');

            return $this->get('oro_ui.router')->redirectAfterSave(
                [ 'route' => $meta->getRoute('edit'), 'parameters' => [ 'id' => $entity->getId() ] ],
                [ 'route' => $meta->getRoute('name') ],
                $entity
            );
        }

        $config = $this->getConfig('entity', $entity);

        return [
            'entity' => $entity,
            'form' => $form->createView(),
            'alias' => $config->get('alias'),
            'context' => $config->get('alias') ?: null
        ];
    }

    /**
     * {@inheritdoc}
     * @param boolean $translate
     */
    protected function addFlash($type, $message, $translate = false)
    {
        parent::addFlash($type, $translate ? $this->get('translator')->trans($message) : $message);
    }
}
