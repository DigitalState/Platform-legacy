<?php

namespace Ds\Bundle\UserBundle\Data\Resolver;

use Ds\Bundle\DataBundle\Data\Resolver\Resolver;
use Symfony\Component\Security\Core\SecurityContext;
use Ds\Bundle\UserPersonaBundle\Manager\PersonaManager;
use DomainException;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Class SessionResolver
 */
class SessionResolver implements Resolver
{
    /**
     * @const string
     */
    const PATTERN = '/^ds\.session\.user\./';

    /**
     * @var \Oro\Bundle\UserBundle\Entity\User
     */
    protected $user;

    /**
     * @var \Ds\Bundle\UserPersonaBundle\Manager\PersonaManager
     */
    protected $personaManager;

    /**
     * Constructor
     *
     * @param \Symfony\Component\Security\Core\SecurityContext $context
     * @param \Ds\Bundle\UserPersonaBundle\Manager\PersonaManager $personaManager
     */
    public function __construct(SecurityContext $context, PersonaManager $personaManager)
    {
        $token = $context->getToken();

        if ($token) {
            $this->user = $token->getUser();
        }

        $this->personaManager = $personaManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getPattern()
    {
        return static::PATTERN;
    }

    /**
     * {@inheritdoc}
     */
    public function isMatch($variable)
    {
        return preg_match(static::PATTERN, $variable);
    }

    /**
     * {@inheritdoc}
     */
    public function get($variable)
    {
        if (!preg_match(static::PATTERN, $variable, $matches)) {
            throw new DomainException('Variable pattern is not valid.');
        }

        $property = preg_replace(static::PATTERN, '', $variable);

        // @todo Make this prettier and work with other subentities.
        if (preg_match('/^personas\(([0-9]+|(,?\s?[a-zA-Z]+=([0-9]+|\"[^\"]*\"))*)\)/', $property, $matches)) {
            $criteria = $matches[1];

            if (preg_match('/^[0-9]+$/', $criteria)) {
                $criteria = [
                    'id' => $criteria
                ];
            } else {
                preg_match_all('/([^,=\s]+)=([0-9]+|\"[^,=\s]+\")/', $criteria, $result);
                $criteria = [];

                foreach ($result[2] as $key => $value) {
                    if (preg_match('/^[0-9]+$/', $value)) {

                    } else {
                        $value = substr($value, 1, -1);
                    }

                    $criteria[$result[1][$key]] = $value;
                }
            }

            $property = preg_replace('/^personas\(([0-9]+|(,?\s?[a-zA-Z]+=([0-9]+|\"[^\"]*\"))*)\)/', '', $property);
            $personas = [];

            foreach ($this->personaManager->getList(null, null, [ 'user' => $this->user ]) as $persona) {
                foreach ($criteria as $key => $value) {
                    if ($persona->{'get' . ucfirst($key)}() != $value) {
                        continue 2;
                    }
                }

                $personas[] = $persona;
            }

            if ('' !== $property) {
                $accessor = PropertyAccess::createPropertyAccessor();

                return $accessor->getValue($personas, $property);
            } else {
                return $personas;
            }
        } else if ('' !== $property) {
            $accessor = PropertyAccess::createPropertyAccessor();

            return $accessor->getValue($this->user, $property);
        } else {
            return $this->user;
        }
    }
}
