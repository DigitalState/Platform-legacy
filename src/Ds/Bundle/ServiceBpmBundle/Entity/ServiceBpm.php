<?php

namespace Ds\Bundle\ServiceBpmBundle\Entity;

use Ds\Bundle\ServiceBundle\Entity\Service;
use Ds\Bundle\BpmBundle\Entity\Attribute;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ServiceBpm
 *
 * @Config(
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="service",
 *              "alias"="bpm"
 *          },
 *          "security"={
 *              "type"="ACL",
 *              "permissions"="All"
 *          },
 *          "manager"={
 *              "default"="ds.servicebpm.manager.servicebpm"
 *          },
 *          "form"={
 *              "form_type"="ds_servicebpm_servicebpm"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\ServiceBpmBundle\Repository\ServiceBpmRepository")
 * @ORM\Table(name="ds_servicebpm")
 * @ORM\HasLifecycleCallbacks()
 */
class ServiceBpm extends Service
{
    use Attribute\Bpm;
    use Attribute\BpmId;
}
