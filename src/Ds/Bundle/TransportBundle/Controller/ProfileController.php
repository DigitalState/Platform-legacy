<?php

namespace Ds\Bundle\TransportBundle\Controller;

use Ds\Bundle\AdminBundle\Controller\BreadController;
use Ds\Bundle\TransportBundle\Entity\Profile;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Twilio\Rest\Api\V2010\Account\MessageList;

/**
 * Class ProfileController
 *
 * @Route("/transport/profile")
 */
class ProfileController extends BreadController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('profile');
    }

    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     * @AclAncestor("ds.transport.profile.view")
     */
    public function indexAction()
    {
        return $this->handleIndex();
    }

    /**
     * View action
     *
     * @param \Ds\Bundle\TransportBundle\Entity\Profile $entity
     * @return array
     * @Route("/view/{id}", requirements={"id"="\d+"})
     * @Template()
     * @AclAncestor("ds.transport.profile.view")
     */
    public function viewAction(Profile $entity)
    {
        return $this->handleView($entity);
    }

    /**
     * Create action
     *
     * @param string $alias
     * @return array
     * @Route("/create/{alias}", requirements={"alias":"[a-z]*"}, defaults={"alias":""})
     * @Template("DsTransportBundle:Profile:edit.html.twig")
     * @AclAncestor("ds.transport.profile.create")
     */
    public function createAction($alias)
    {
        return $this->handleCreate($alias);
    }

    /**
     * Edit action
     *
     * @param \Ds\Bundle\TransportBundle\Entity\Profile $entity
     * @return array
     * @Route("/update/{id}", requirements={"id":"\d+"}, defaults={"id":0})
     * @Template()
     * @AclAncestor("ds.transport.profile.edit")
     */
    public function editAction(Profile $entity)
    {
        return $this->handleEdit($entity);
    }
}
