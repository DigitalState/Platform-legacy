<?php

namespace Ds\Bundle\PortalBundle\Controller\Portal;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class ResetController
 *
 * @Route("/")
 */
class ResetController extends Controller
{
    /**
     * Reset action
     *
     * @Route("/reset")
     */
    public function resetAction()
    {
        $manager = $this->get('ds.case.manager.case');
        $om = $manager->getObjectManager();

        foreach ($manager->getList(null, null) as $case) {
            $om->remove($case);
            $om->flush();
        }

        $manager = $this->get('ds.service.manager.activation');
        $om = $manager->getObjectManager();

        foreach ($manager->getList(null, null) as $activation) {
            $om->remove($activation);
            $om->flush();
        }

        $api = new \org\camunda\php\sdk\Api('http://localhost:8080/engine-rest');
        $request = new \org\camunda\php\sdk\entity\request\ProcessInstanceRequest;
        $instances = (array) $api->processInstance->getInstances($request);

        foreach ($instances as $instance) {
            $api->processInstance->deleteInstance($instance->getId());
        }

        return $this->redirectToRoute('ds_portal_portal_home_index');
    }
}
