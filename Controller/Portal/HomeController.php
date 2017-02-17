<?php

namespace Ds\Bundle\PortalBundle\Controller\Portal;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class HomeController
 *
 * @Route("/")
 */
class HomeController extends Controller
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
        ];
    }
}
