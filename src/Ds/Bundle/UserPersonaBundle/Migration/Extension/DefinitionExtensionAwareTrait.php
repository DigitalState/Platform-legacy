<?php

namespace Ds\Bundle\UserPersonaBundle\Migration\Extension;

/**
 * Trait DefinitionExtensionAwareTrait
 */
trait DefinitionExtensionAwareTrait
{
    /**
     * @var \Ds\Bundle\UserPersonaBundle\Migration\Extension\DefinitionExtension
     */
    protected $definitionExtension; # region accessors

    /**
     * Sets the definition extension
     *
     * @param \Ds\Bundle\UserPersonaBundle\Migration\Extension\DefinitionExtension $definitionExtension
     */
    public function setDefinitionExtension(DefinitionExtension $definitionExtension)
    {
        $this->definitionExtension = $definitionExtension;
    }

    # endregion
}
