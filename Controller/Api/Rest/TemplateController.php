<?php

namespace Ds\Bundle\CommunicationBundle\Controller\Api\Rest;

use Ds\Bundle\ApiBundle\Controller\Api\Rest\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class TemplateController
 *
 * @RouteResource("template")
 * @Route("/communication")
 * @NamePrefix("ds_communication_api_rest_")
 */
class TemplateController extends AbstractController
{
    /**
     * Get collection action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @AclAncestor("ds.communication.template.view")
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
     * @AclAncestor("ds.communication.template.view")
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
     * @AclAncestor("ds.communication.template.edit")
     */
    public function putAction($id)
    {
        return $this->handleUpdateRequest($id);
    }

    /**
     * Post action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @AclAncestor("ds.communication.template.create")
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
     * @AclAncestor("ds.communication.template.delete")
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
        return $this->get('ds.communication.form.api.template');
    }

    /**
     * {@inheritdoc}
     */
    public function getFormHandler()
    {
        return $this->get('ds.communication.form.handler.template');
    }

    /**
     * {@inheritdoc}
     */
    public function getManager()
    {
        return $this->get('ds.communication.manager.template');
    }

    /**
     * {@inheritdoc}
     */
    protected function transformEntityField($field, &$value)
    {
        switch ($field) {
            default:
                parent::transformEntityField($field, $value);
        }
    }
}
