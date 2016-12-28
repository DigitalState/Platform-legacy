<?php

namespace Ds\Bundle\AssetBundle\Migration\Extension;

/**
 * Interface AssetExtensionAwareInterface
 */
interface AssetExtensionAwareInterface
{
    /**
     * Sets the asset extension
     *
     * @param \Ds\Bundle\AssetBundle\Migration\Extension\AssetExtension $assetExtension
     */
    public function setAssetExtension(AssetExtension $assetExtension);
}
