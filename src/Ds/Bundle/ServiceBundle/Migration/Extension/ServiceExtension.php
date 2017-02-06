<?php

namespace Ds\Bundle\ServiceBundle\Migration\Extension;

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

            //Get all localizations
            $localizations = $this->localizationRepository->findAll();
            foreach ($localizations as $localization) {
                $locale = $localization->getLanguageCode();
                if ($item['titles'][$locale]) {
                    $localized = new LocalizedFallbackValue();
                    $localized->setLocalization($localization);
                    $localized->setText($item['titles'][$locale]);
                    $service->addTitle($localized);
                }
                if ($item['descriptions'][$locale]) {
                    $localized = new LocalizedFallbackValue();
                    $localized->setLocalization($localization);
                    $localized->setText($item['descriptions'][$locale]);
                    $service->addDescription($localized);
                }
                if ($item['buttons'][$locale]) {
                    $localized = new LocalizedFallbackValue();
                    $localized->setLocalization($localization);
                    $localized->setText($item['buttons'][$locale]);
                    $service->addButton($localized);
                }
                if ($item['presentations'][$locale]) {
                    $localized = new LocalizedFallbackValue();
                    $localized->setLocalization($localization);
                    $localized->setText($item['presentations'][$locale]);
                    $service->addPresentation($localized);
                }
            }

            //Set default Locale value
            $service->setDefaultTitle(reset($item['titles']));
            $service->setDefaultDescription(reset($item['descriptions']));
            $service->setDefaultButton(reset($item['buttons']));
            $service->setDefaultDescription(reset($item['descriptions']));

            $service->setIcon($item['icon']);
            $service->setSlug($item['slug']);

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
