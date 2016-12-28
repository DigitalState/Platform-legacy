<?php

namespace Ds\Bundle\AccountRecordBundle\Controller\Account;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class RecordController
 *
 * @Route("/record")
 */
class RecordController extends Controller
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
        $manager = $this->get('ds.record.manager.record');
        $record = $manager->find($id);

        return [
            'record' => $record
        ];
    }
}
