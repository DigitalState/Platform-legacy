<?php

namespace Ds\Bundle\UserPersonaBundle\Migration\Extension;

/**
 * Interface PersonaExtensionAwareInterface
 */
interface PersonaExtensionAwareInterface
{
    /**
     * Sets the persona extension
     *
     * @param \Ds\Bundle\UserPersonaBundle\Migration\Extension\PersonaExtension $personaExtension
     */
    public function setPersonaExtension(PersonaExtension $personaExtension);
}
