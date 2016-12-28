<?php

namespace Ds\Bundle\AssetBundle\Migration\Extension;

/**
 * Trait AssetExtensionAwareInterface
 */
trait AssetExtensionAwareTrait
{
    /**
     * @var \Ds\Bundle\AssetBundle\Migration\Extension\AssetExtension
     */
    protected $assetExtension; # region accessors

    /**
     * {@inheritdoc}
     */
    public function setAssetExtension(AssetExtension $assetExtension)
    {
        $this->assetExtension = $assetExtension;
    }

    # endregion
}
