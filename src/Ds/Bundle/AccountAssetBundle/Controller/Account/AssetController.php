<?php

namespace Ds\Bundle\AccountAssetBundle\Controller\Account;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class AssetController
 *
 * @Route("/asset")
 */
class AssetController extends Controller
{
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
        $manager = $this->get('ds.asset.manager.asset');
        $asset = $manager->find($id);

        return [
            'asset' => $asset
        ];
    }
}
