<?php

namespace Ds\Bundle\UserPersonaBundle\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFunction;
use Symfony\Component\Security\Core\SecurityContext;
use Ds\Bundle\UserPersonaBundle\Manager\PersonaManager;
use Ds\Bundle\UserPersonaBundle\Manager\DefinitionManager;

/**
 * Class PersonaExtension
 */
class PersonaExtension extends Twig_Extension
{
    /**
     * @var \Oro\Bundle\UserBundle\Entity\User
     */
    protected $user;

    /**
     * @var \Ds\Bundle\UserPersonaBundle\Manager\PersonaManager
     */
    protected $personaManager;

    /**
     * @var \Ds\Bundle\UserPersonaBundle\Manager\DefinitionManager
     */
    protected $definitionManager;

    /**
     * Constructor
     *
     * @param \Symfony\Component\Security\Core\SecurityContext $context
     * @param \Ds\Bundle\UserPersonaBundle\Manager\PersonaManager $personaManager
     * @param \Ds\Bundle\UserPersonaBundle\Manager\DefinitionManager $definitionManager
     */
    public function __construct(SecurityContext $context, PersonaManager $personaManager, DefinitionManager $definitionManager)
    {
        $token = $context->getToken();

        if ($token) {
            $this->user = $token->getUser();
        }

        $this->personaManager = $personaManager;
        $this->definitionManager = $definitionManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('ds_persona', [ $this, 'getPersona' ])
        ];
    }

    /**
     * Get persona
     *
     * @param string $definition
     * @param string $property
     * @return string
     */
    public function getPersona($definition, $property)
    {
        $definitions = $this->definitionManager->getList(1, 1, [ 'slug' => $definition ]);
        $definition = array_shift($definitions);

        $personas = $this->personaManager->getList(1, 1, [ 'user' => $this->user, 'definition' => $definition ]);
        $persona = array_shift($personas);

        return $persona->getData($property);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ds_persona_extension';
    }
}