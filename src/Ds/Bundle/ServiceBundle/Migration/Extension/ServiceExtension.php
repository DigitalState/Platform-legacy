<?php

/*
 *  PROTOTYPE for services.yml file
 *  services:
 *   -
 *     titles:
 *        en: ~
 *        fr: ~
 *     descriptions:
 *        en: ~
 *        fr: ~
 *     buttons:
 *        en: ~
 *        fr: ~
 *     presentations:
 *        en: ~
 *        fr: ~
 *     owner: ~
 *     organization: default
 *     icon: fa-gg
 */
namespace Montreal\Bundle\ServiceBundle\Migration\Extension;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue;
use Symfony\Component\Yaml\Yaml;
use Ds\Bundle\ServiceBundle\Entity\Service;
use Oro\Bundle\LocaleBundle\Entity\Repository\LocalizationRepository;

/**
 * Class ServiceExtension
 */
class ServiceExtension
{
    /**
     * @var \Oro\Bundle\LocaleBundle\Entity\Repository\LocalizationRepository;
     */
    protected $localizationRepository;

    /**
     * Constructor
     *
     * @param \Oro\Bundle\LocaleBundle\Entity\Repository\LocalizationRepository $localizationRepository
     */
    public function __construct(LocalizationRepository $localizationRepository)
    {
        $this->localizationRepository = $localizationRepository;
    }

    /**
     * Import resource
     *
     * @param string $resource
     * @param \Doctrine\Common\Persistence\ObjectManager $objectManager
     */
    public function import($resource, ObjectManager $objectManager)
    {
        $data = Yaml::parse(file_get_contents($resource));

        foreach ($data['services'] as $item) {
            if (array_key_exists('prototype', $data)) {
                $item += $data['prototype'];
            }

            $service = new Service();
            $values = [];

            #region TITLES DESCRIPTIONS BUTTONS PRESENTATIONS
            foreach ([ 'titles', 'descriptions', 'buttons', 'presentations' ] as $field) {
                //Set default Locale value
                $localized = new LocalizedFallbackValue();
                $localized->setText(current($item[$field]));
                $values[$field] = new ArrayCollection([$localized]);

                foreach ($item[$field] as $locale => $localeValue) {
                    //If location for title exists in .yml file
                    $localization = $this->localizationRepository->findOneBy([ 'formattingCode' => $locale ]);
                    if ($localization) {
                        $localized = new LocalizedFallbackValue();
                        $localized->setText($localeValue);
                        $localized->setLocalization($localization);
                        $values[$field]->add($localized);
                    }
                }
                $service->{'set' . $field}($values[$field]);
            }

            $service->setIcon($item['icon']);
            $service->setSlug($item['slug']);
            #endregion

            #region OWNER
            $owner = $objectManager
                ->getRepository('OroOrganizationBundle:BusinessUnit')
                ->findOneBy([ 'name' => $item['owner'] ]);

            if (!$owner) {
                throw new RuntimeException('Business unit does not exist.');
            }

            $service->setOwner($owner);
            #endregion OWNER

            #region ORGANIZATION
            $organization = $objectManager
                ->getRepository('OroOrganizationBundle:Organization')
                ->findOneBy([ 'name' => $item['organization'] ]);

            if (!$organization) {
                throw new RuntimeException('Organization does not exist.');
            }

            $service->setOrganization($organization);
            #endregion ORGANIZATION

            $objectManager->persist($service);
            $objectManager->flush();
        }
    }
}
