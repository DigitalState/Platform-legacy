<?php

namespace Ds\Bundle\DataGridBundle\Datasource\Repository;

use Oro\Bundle\DataGridBundle\Datagrid\DatagridInterface;
use Oro\Bundle\DataGridBundle\Datasource\DatasourceInterface;
use Oro\Bundle\DataGridBundle\Datasource\ParameterBinderAwareInterface;
use Oro\Bundle\DataGridBundle\Datasource\ParameterBinderInterface;
use Oro\Bundle\DataGridBundle\Datasource\Orm\QueryConverter\YamlConverter;
use Oro\Bundle\DataGridBundle\Datasource\ResultRecord;
use Oro\Bundle\DataGridBundle\Datasource\ResultRecordInterface;
use Oro\Bundle\DataGridBundle\Exception\BadMethodCallException;
use Oro\Bundle\DataGridBundle\Exception\DatasourceException;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Class RepositoryDatasource
 */
class RepositoryDatasource implements DatasourceInterface
{
    /**
     * @const string
     */
    const TYPE = 'repository';

    /**
     * @var \Oro\Bundle\DataGridBundle\Datagrid\DatagridInterface
     */
    protected $datagrid;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    protected $repository;

    /**
     * Process datagrid
     *
     * @param \Oro\Bundle\DataGridBundle\Datagrid\DatagridInterface $datagrid
     * @param array $config
     * @throws \Exception
     */
    public function process(DatagridInterface $datagrid, array $config)
    {
        $this->datagrid = $datagrid;

        if (!array_key_exists('repository', $config)) {
            throw new \Exception;
        }

        if (!$config['repository'] instanceof ObjectRepository) {
            throw new \Exception;
        }

        $this->repository = $config['repository'];
        $datagrid->setDatasource(clone $this);
    }

    /**
     * Get results
     *
     * @return \Oro\Bundle\DataGridBundle\Datasource\ResultRecordInterface[]
     */
    public function getResults()
    {
        $results = [];

        foreach ($this->repository->findBy([]) as $item) {
            $results[] = new ResultRecord($item);
        }

        return $results;
    }
}
