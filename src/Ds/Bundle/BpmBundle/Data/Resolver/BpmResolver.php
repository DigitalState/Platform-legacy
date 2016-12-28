<?php

namespace Ds\Bundle\BpmBundle\Data\Resolver;

use Ds\Bundle\DataBundle\Data\Resolver\Resolver;
use Ds\Bundle\CaseBundle\Entity\CaseEntity;
use DomainException;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Class BpmResolver
 */
class BpmResolver implements Resolver
{
    /**
     * @const string
     */
    const PATTERN = '/^ds\.bpm\.case\./';

    /**
     * @var \Ds\Bundle\CaseBundle\Entity\CaseEntity
     */
    protected $case; # region accessors

    /**
     * Set case
     *
     * @param \Ds\Bundle\CaseBundle\Entity\CaseEntity $case
     * @return \Ds\Bundle\ServiceBpmBundle\Data\Resolver\BpmResolver
     */
    public function setCase(CaseEntity $case)
    {
        $this->case = $case;

        return $this;
    }

    # endregion

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
        if (preg_match('/^records\(([0-9]+|(,?\s?[a-zA-Z]+=([0-9]+|\"[^\"]*\"))*)\)/', $property, $matches)) {
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

            $property = preg_replace('/^records\(([0-9]+|(,?\s?[a-zA-Z]+=([0-9]+|\"[^\"]*\"))*)\)/', '', $property);
            $records = [];

            foreach ($this->case->getRecords() as $record) {
                foreach ($criteria as $key => $value) {
                    if ($record->{'get' . ucfirst($key)}() != $value) {
                        continue 2;
                    }
                }

                $records[] = $record;
            }

            if ('' !== $property) {
                $accessor = PropertyAccess::createPropertyAccessor();

                return $accessor->getValue($records, $property);
            } else {
                return $records;
            }
        } else if ('' !== $property) {
            $accessor = PropertyAccess::createPropertyAccessor();

            return $accessor->getValue($this->case, $property);
        } else {
            return $this->case;
        }
    }
}
