<?php

namespace Ds\Bundle\EntityBundle\Form\Handler;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class EntityHandler
 */
class EntityHandler
{
    /**
     * @var \Symfony\Component\Form\FormInterface
     */
    protected $form;

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $manager;

    /**
     * Constructor
     *
     * @param \Symfony\Component\Form\FormInterface $form
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function __construct(FormInterface $form, Request $request, ObjectManager $manager) {
        $this->form = $form;
        $this->request = $request;
        $this->manager = $manager;
    }

    /**
     * Process form
     *
     * @param object $entity
     * @return boolean
     */
    public function process($entity)
    {
        $this->form->setData($entity);

        if (in_array($this->request->getMethod(), [ 'POST', 'PUT' ])) {
            $this->form->submit($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($entity);

                return true;
            }
        }

        return false;
    }

    /**
     * On success
     *
     * @param object $entity
     */
    protected function onSuccess($entity)
    {
        $this->manager->persist($entity);
        $this->manager->flush();
    }
}
