<?php

namespace Ds\Bundle\BpmBundle\Collection\Bpm;

use Doctrine\Common\Collections\ArrayCollection;
use Ds\Bundle\BpmBundle\Bpm\Api\Api;

/**
 * Class ApiCollection
 */
class ApiCollection extends ArrayCollection
{
    /**
     * Add api
     *
     * @param \Ds\Bundle\BpmBundle\Bpm\Api\Api $api
     * @param string $alias
     * @return \Ds\Bundle\BpmBundle\Collection\Bpm\ApiCollection
     */
    public function addApi(Api $api, $alias = null)
    {
        return $this->add([
            'api' => $api,
            'alias' => $alias
        ]);
    }
}
