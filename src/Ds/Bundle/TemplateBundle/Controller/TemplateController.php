<?php

namespace Ds\Bundle\TemplateBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\TemplateBundle\Entity\Template as TemplateEntity;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class TemplateController
 *
 * @Route("/template")
 */
class TemplateController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('template');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.template.template.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\TemplateBundle\Entity\Template $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.template.template.view")
     */
    public function viewAction(TemplateEntity $entity)
    {
        return $this->handleView($entity);
    }

    /**
     * Create action
     *
     * @param string $alias
     * @return array
     * @Route("/create/{alias}", requirements={"alias":"[a-z]*"}, defaults={"alias":""})
     * @Template("DsTemplateBundle:Template:edit.html.twig")
     * @AclAncestor("ds.template.template.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\TemplateBundle\Entity\Template $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.template.template.edit")
     */
    public function editAction(TemplateEntity $entity)
    {
        return $this->handleEdit($entity);
    }
}
