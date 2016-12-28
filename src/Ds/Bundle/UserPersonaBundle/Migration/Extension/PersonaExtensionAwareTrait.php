<?php

namespace Ds\Bundle\UserPersonaBundle\Migration\Extension;

/**
 * Trait PersonaExtensionAwareTrait
 */
trait PersonaExtensionAwareTrait
{
    /**
     * @var \Ds\Bundle\UserPersonaBundle\Migration\Extension\PersonaExtension
     */
    protected $personaExtension; # region accessors

    /**
     * Sets the persona extension
     *
     * @param \Ds\Bundle\UserPersonaBundle\Migration\Extension\PersonaExtension $personaExtension
     */
    public function setPersonaExtension(PersonaExtension $personaExtension)
    {
        $this->personaExtension = $personaExtension;
    }

    # endregion
}
