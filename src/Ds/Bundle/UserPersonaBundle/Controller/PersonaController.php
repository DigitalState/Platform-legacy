<?php

namespace Ds\Bundle\UserPersonaBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\UserPersonaBundle\Entity\Persona;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class PersonaController
 *
 * @Route("/user/persona")
 */
class PersonaController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('persona');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.userpersona.persona.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\UserPersonaBundle\Entity\Persona $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.userpersona.persona.view")
     */
    public function viewAction(Persona $entity)
    {
        return $this->handleView($entity);
    }

    /**
     * Create action
     *
     * @param string $alias
     * @return array
     * @Route("/create/{alias}", requirements={"alias":"[a-z]*"}, defaults={"alias":""})
     * @Template("DsUserPersonaBundle:Persona:edit.html.twig")
     * @AclAncestor("ds.userpersona.persona.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\UserPersonaBundle\Entity\Persona $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.userpersona.persona.edit")
     */
    public function editAction(Persona $entity)
    {
        return $this->handleEdit($entity);
    }
}
