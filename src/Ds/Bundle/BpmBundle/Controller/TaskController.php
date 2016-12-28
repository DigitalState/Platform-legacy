<?php

namespace Ds\Bundle\BpmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class TaskController
 *
 * @Route("/bpm/task")
 */
class TaskController extends Controller
{
    /**
     * Index action
     *
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return [
            'gridName' => 'ds-bpm-task'
        ];
    }
}
