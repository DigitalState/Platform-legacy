<?php

namespace Ds\Bundle\UserPersonaBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\UserPersonaBundle\Entity\Definition;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class DefinitionController
 *
 * @Route("/user/persona/definition")
 */
class DefinitionController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('persona_definition');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.userpersona.definition.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\UserPersonaBundle\Entity\Definition $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.userpersona.definition.view")
     */
    public function viewAction(Definition $entity)
    {
        return $this->handleView($entity);
    }

    /**
     * Create action
     *
     * @param string $alias
     * @return array
     * @Route("/create/{alias}", requirements={"alias":"[a-z]*"}, defaults={"alias":""})
     * @Template("DsUserPersonaBundle:Definition:edit.html.twig")
     * @AclAncestor("ds.userpersona.definition.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\UserPersonaBundle\Entity\Definition $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.userpersona.definition.edit")
     */
    public function editAction(Definition $entity)
    {
        return $this->handleEdit($entity);
    }
}
