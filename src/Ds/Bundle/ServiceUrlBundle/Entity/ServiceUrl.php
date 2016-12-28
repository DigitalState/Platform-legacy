<?php

namespace Ds\Bundle\ServiceUrlBundle\Entity;

use Ds\Bundle\ServiceBundle\Entity\Service;
use Ds\Bundle\EntityBundle\Entity\Attribute;
use Doctrine\Common\Collections\ArrayCollection;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ServiceUrl
 *
 * @Config(
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="service",
 *              "alias"="url"
 *          },
 *          "security"={
 *              "type"="ACL",
 *              "permissions"="All"
 *          },
 *          "manager"={
 *              "default"="ds.serviceurl.manager.serviceurl"
 *          },
 *          "form"={
 *              "form_type"="ds_serviceurl_serviceurl"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\ServiceUrlBundle\Repository\ServiceUrlRepository")
 * @ORM\Table(name="ds_serviceurl")
 * @ORM\HasLifecycleCallbacks()
 */
class ServiceUrl extends Service
{
    use Attribute\Localized\Url;

    /**
     * @var \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue[]
     * @ORM\ManyToMany(
     *      targetEntity="Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue",
     *      cascade={"ALL"},
     *      orphanRemoval=true
     * )
     * @ORM\JoinTable(
     *      name="ds_serviceurl_url",
     *      joinColumns={ @ORM\JoinColumn(name="service_id", referencedColumnName="id", onDelete="CASCADE") },
     *      inverseJoinColumns={ @ORM\JoinColumn(name="localized_value_id", referencedColumnName="id", onDelete="CASCADE", unique=true) }
     * )
     */
    protected $urls;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->urls = new ArrayCollection;
    }
}
