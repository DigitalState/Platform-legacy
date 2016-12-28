<?php

namespace Ds\Bundle\AssetBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\AssetBundle\Entity\Asset;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class AssetController
 *
 * @Route("/asset")
 */
class AssetController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('asset');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.asset.asset.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\AssetBundle\Entity\Asset $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.asset.asset.view")
     */
    public function viewAction(Asset $entity)
    {
        return $this->handleView($entity);
    }

    /**
     * Create action
     *
     * @param string $alias
     * @return array
     * @Route("/create/{alias}", requirements={"alias":"[a-z]*"}, defaults={"alias":""})
     * @Template("DsAssetBundle:Asset:edit.html.twig")
     * @AclAncestor("ds.asset.asset.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\AssetBundle\Entity\Asset $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.asset.asset.edit")
     */
    public function editAction(Asset $entity)
    {
        return $this->handleEdit($entity);
    }
}
