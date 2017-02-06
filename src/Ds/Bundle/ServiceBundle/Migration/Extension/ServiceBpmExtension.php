<?php

namespace Ds\Bundle\ServiceBundle\Migration\Extension;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue;
use Symfony\Component\Yaml\Yaml;
use Ds\Bundle\ServiceBpmBundle\Entity\ServiceBpm;
use Oro\Bundle\LocaleBundle\Entity\Repository\LocalizationRepository;

/**
 * Class ServiceExtension
 */
class ServiceBpmExtension
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
            $serviceBpm = new ServiceBpm();

            #region TITLES
            //Set default Locale value
            $localized = new LocalizedFallbackValue();
            $localized->setText($item['titles']['0']['text']);
            $titles = new ArrayCollection([$localized]);

            //Set all others location in .yml file
            foreach ($item['titles'] as $localeValue) {
                //If location for title exists in .yml file
                if ($localeValue['localization']) {
                    $locale = $localeValue['localization'];
                    $localization = $this->localizationRepository->findOneBy([ 'formattingCode' => $locale ]);
                    if ($localization) {
                        $localized = new LocalizedFallbackValue();
                        $localized->setText($localeValue['text']);
                        $localized->setLocalization($localization);
                        $titles->add($localized);
                    }
                }
            }
            $serviceBpm->setTitles($titles);
            #endregion Titles

            #region DESCRIPTIONS
            //Set default Locale value
            $localized = new LocalizedFallbackValue();
            $localized->setText($item['descriptions']['0']['text']);
            $descriptions = new ArrayCollection([$localized]);

            //Set all others location in .yml file
            foreach ($item['descriptions'] as $localeValue) {
                //If location for title exists in .yml file
                if ($localeValue['localization']) {
                    $locale = $localeValue['localization'];
                    $localization = $this->localizationRepository->findOneBy([ 'formattingCode' => $locale ]);
                    if ($localization) {
                        $localized = new LocalizedFallbackValue();
                        $localized->setText($localeValue['text']);
                        $localized->setLocalization($localization);
                        $descriptions->add($localized);
                    }
                }
            }
            $serviceBpm->setDescriptions($descriptions);
            #endregion DESCRIPTIONS

            $serviceBpm->setIcon($item['icon']);

            #region BUTTONS
            //Set default Locale value
            $localized = new LocalizedFallbackValue();
            $localized->setText($item['buttons']['0']['text']);
            $buttons = new ArrayCollection([$localized]);

            //Set all others location in .yml file
            foreach ($item['buttons'] as $localeValue) {
                //If location for title exists in .yml file
                if ($localeValue['localization']) {
                    $locale = $localeValue['localization'];
                    $localization = $this->localizationRepository->findOneBy([ 'formattingCode' => $locale ]);
                    if ($localization) {
                        $localized = new LocalizedFallbackValue();
                        $localized->setText($localeValue['text']);
                        $localized->setLocalization($localization);
                        $buttons->add($localized);
                    }
                }
            }
            $serviceBpm->setButtons($buttons);
            #endregion BUTTONS

            #region PRESENTATIONS
            //Set default Locale value
            $localized = new LocalizedFallbackValue();
            $localized->setText($item['descriptions']['0']['text']);
            $presentations = new ArrayCollection([$localized]);

            //Set all others location in .yml file
            foreach ($item['presentations'] as $localeValue) {
                //If location for title exists in .yml file
                if ($localeValue['localization']) {
                    $locale = $localeValue['localization'];
                    $localization = $this->localizationRepository->findOneBy([ 'formattingCode' => $locale ]);
                    if ($localization) {
                        $localized = new LocalizedFallbackValue();
                        $localized->setText($localeValue['text']);
                        $localized->setLocalization($localization);
                        $presentations->add($localized);
                    }
                }
            }
            $serviceBpm->setPresentations($presentations);
            #endregion PRESENTATIONS

            $serviceBpm->setSlug($item['slug']);

            #region OWNER
            $owner = $objectManager
                ->getRepository('OroOrganizationBundle:BusinessUnit')
                ->findOneBy([ 'name' => $item['owner'] ]);

            if (!$owner) {
                throw new RuntimeException('Business unit does not exist.');
            }

            $serviceBpm->setOwner($owner);
            #endregion OWNER

            #region ORGANIZATION
            $organization = $objectManager
                ->getRepository('OroOrganizationBundle:Organization')
                ->findOneBy([ 'name' => $item['organization'] ]);

            if (!$organization) {
                throw new RuntimeException('Organization does not exist.');
            }

            $serviceBpm->setOrganization($organization);
            #endregion ORGANIZATION

            $serviceBpm->setBpm($item['bpm']);

            $serviceBpm->setBpmId($item['bpmId']);

            $objectManager->persist($serviceBpm);
            $objectManager->flush();
        }
    }
}
