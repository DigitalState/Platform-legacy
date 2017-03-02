<?php

namespace Ds\Bundle\PortalApiBundle\Controller\Portal\Api\Rest;

use Doctrine\Common\Collections\Criteria;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;

/**
 * Class ServiceController
 *
 * @RouteResource("service")
 * @NamePrefix("ds_portalapi_portal_api_rest_")
 */
class ServiceController extends AbstractController
{
    /**
     * Get collection action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @QueryParam(name="page", requirements="\d+", nullable=true)
     * @QueryParam(name="limit", requirements="\d+", nullable=true)
     */
    public function cgetAction()
    {
        $request = $this->get('request');
        $page = (integer) $request->get('page', 1);
        $limit = (integer) $request->get('limit', self::ITEMS_PER_PAGE);
        $criteria = $this->getFilterCriteria($this->getSupportedQueryParameters(__FUNCTION__));

        $expression = Criteria::expr();
        $criteria->andWhere($expression->eq('e.enabled', 1));

        return $this->handleGetListRequest($page, $limit, $criteria);
    }

    /**
     * Get action
     *
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction($id)
    {
        return $this->handleGetRequest($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getFormHandler()
    {
        return null;
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
                $value = $this->transformLocalizedValuesToCurrentLocaleText($value);
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
