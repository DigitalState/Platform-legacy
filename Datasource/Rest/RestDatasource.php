<?php

namespace Ds\Bundle\DataGridBundle\Datasource\Rest;

use Oro\Bundle\DataGridBundle\Datagrid\DatagridInterface;
use Oro\Bundle\DataGridBundle\Datasource\DatasourceInterface;
use Oro\Bundle\DataGridBundle\Datasource\ParameterBinderAwareInterface;
use Oro\Bundle\DataGridBundle\Datasource\ParameterBinderInterface;
use Oro\Bundle\DataGridBundle\Datasource\Orm\QueryConverter\YamlConverter;
use Oro\Bundle\DataGridBundle\Datasource\ResultRecord;
use Oro\Bundle\DataGridBundle\Datasource\ResultRecordInterface;
use Oro\Bundle\DataGridBundle\Exception\BadMethodCallException;
use Oro\Bundle\DataGridBundle\Exception\DatasourceException;

/**
 * Class RestDatasource
 */
class RestDatasource implements DatasourceInterface
{
    /**
     * @const string
     */
    const TYPE = 'rest';

    /**
     * @var \Oro\Bundle\DataGridBundle\Datagrid\DatagridInterface
     */
    protected $datagrid;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * Process datagrid
     *
     * @param \Oro\Bundle\DataGridBundle\Datagrid\DatagridInterface $datagrid
     * @param array $config
     */
    public function process(DatagridInterface $datagrid, array $config)
    {
        $this->datagrid = $datagrid;
        $this->endpoint = $config['endpoint'];
        $datagrid->setDatasource(clone $this);
    }

    /**
     * Get results
     *
     * @return \Oro\Bundle\DataGridBundle\Datasource\ResultRecordInterface[]
     */
    public function getResults()
    {
        $response = json_decode(file_get_contents($this->endpoint));
        $results = [];

        foreach ($response as $item) {
            $results[] = new ResultRecord($item);
        }

        return $results;
    }
}
