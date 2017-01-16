<?php

namespace Ds\Bundle\ServiceBundle\Controller\Api\Rest;

use Ds\Bundle\ApiBundle\Controller\Api\Rest\AbstractController;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class ServiceController
 *
 * @RouteResource("service")
 * @NamePrefix("ds_service_api_rest_")
 */
class ServiceController extends AbstractController
{
    /**
     * Get collection action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @AclAncestor("ds.service.service.view")
     * @QueryParam(name="page", requirements="\d+", nullable=true)
     * @QueryParam(name="limit", requirements="\d+", nullable=true)
     */
    public function cgetAction()
    {
        $request = $this->get('request');
        $page = (integer) $request->get('page', 1);
        $limit = (integer) $request->get('limit', self::ITEMS_PER_PAGE);
        $criteria = $this->getFilterCriteria($this->getSupportedQueryParameters(__FUNCTION__));

        return $this->handleGetListRequest($page, $limit, $criteria);
    }

    /**
     * Get action
     *
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @AclAncestor("ds.service.service.view")
     */
    public function getAction($id)
    {
        return $this->handleGetRequest($id);
    }

    /**
     * Put action
     *
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @AclAncestor("ds.service.service.edit")
     */
    public function putAction($id)
    {
        return $this->handleUpdateRequest($id);
    }

    /**
     * Post action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @AclAncestor("ds.service.service.create")
     */
    public function postAction()
    {
        return $this->handleCreateRequest();
    }

    /**
     * Delete action
     *
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @AclAncestor("ds.service.service.delete")
     */
    public function deleteAction($id)
    {
        return $this->handleDeleteRequest($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getForm()
    {
        return $this->get('ds.service.form.api.service');
    }

    /**
     * {@inheritdoc}
     */
    public function getFormHandler()
    {
        return $this->get('ds.service.form.handler.service');
    }

    /**
     * {@inheritdoc}
     */
    public function getManager()
    {
        return $this->get('ds.service.manager.service');
    }

    /**
     * {@inheritdoc}
     */
    protected function transformEntityField($field, &$value)
    {
        switch ($field) {
            case 'titles':
            case 'descriptions':
            case 'buttons':
            case 'presentations':
                $value = $this->transformLocalizedValuesToTexts($value);
                break;

            default:
                parent::transformEntityField($field, $value);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getFallbackLocalizationFields()
    {
        return [ 'titles', 'descriptions', 'buttons', 'presentations' ];
    }
}
