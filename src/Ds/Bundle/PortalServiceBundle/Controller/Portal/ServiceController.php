<?php

namespace Ds\Bundle\PortalServiceBundle\Controller\Portal;

use Ds\Bundle\EntityBundle\Controller\EntityController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class ServiceController
 *
 * @Route("/service")
 */
class ServiceController extends EntityController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('service');
    }

    /**
     * Index action
     *
     * @Route("s")
     * @Template()
     */
    public function indexAction()
    {
        $manager = $this->get('ds.service.manager.service');
        $services = $manager->getList();

        return [
            'services' => $services
        ];
    }

    /**
     * View action
     *
     * @param integer $id
     * @return array
     * @Route("/{id}")
     * @Template()
     */
    public function viewAction($id)
    {
        $manager = $this->get('ds.service.manager.service');
        $service = $manager->find($id);

        return [
            'service' => $service
        ];
    }

    /**
     * Activate action
     *
     * @param integer $id
     * @return array
     * @Route("/activate/{id}")
     * @Method({"POST"})
     */
    public function activateAction($id)
    {
        $manager = $this->get('ds.service.manager.service');
        $service = $manager->find($id);
        $config = $this->getConfig('manager', $service);
        $manager = $this->get($config->get('default'));
        $user = $this->getUser();
        $url = $manager->activate($service, $user);

        if ($url) {
            return $this->redirect($url);
        } else {
            return $this->redirectToRoute('ds_portalservice_portal_service_activated', [ 'id' => $service->getId() ]);
        }
    }

    /**
     * Activated action
     *
     * @param integer $id
     * @return array
     * @Route("/activated/{id}")
     * @Template()
     */
    public function activatedAction($id)
    {
        $manager = $this->get('ds.service.manager.service');
        $service = $manager->find($id);

        return [
            'service' => $service
        ];
    }
}
