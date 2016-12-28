<?php

namespace Ds\Bundle\UserPersonaBundle\Migration\Extension;

/**
 * Interface DefinitionExtensionAwareInterface
 */
interface DefinitionExtensionAwareInterface
{
    /**
     * Sets the definition extension
     *
     * @param \Ds\Bundle\UserPersonaBundle\Migration\Extension\DefinitionExtension $definitionExtension
     */
    public function setDefinitionExtension(DefinitionExtension $definitionExtension);
}
