<?php

namespace Ds\Bundle\UserPersonaBundle\Controller\Api\Rest;

use Oro\Bundle\SoapBundle\Controller\Api\Rest\RestController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class DefinitionController
 *
 * @RouteResource("definition")
 * @Route("/user/persona")
 * @NamePrefix("ds_userpersona_api_rest_")
 */
class DefinitionController extends RestController
{
    /**
     * Get collection action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @AclAncestor("ds.userpersona.definition.view")
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
     * @AclAncestor("ds.userpersona.definition.view")
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
     * @AclAncestor("ds.userpersona.definition.edit")
     */
    public function putAction($id)
    {
        return $this->handleUpdateRequest($id);
    }

    /**
     * Post action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @AclAncestor("ds.userpersona.definition.create")
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
     * @AclAncestor("ds.userpersona.definition.delete")
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
    }

    /**
     * {@inheritdoc}
     */
    public function getFormHandler()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getManager()
    {
        return $this->get('ds.userpersona.manager.definition');
    }
}
