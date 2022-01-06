<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\Doctrine\Type\Contract;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Platforms\MySqlPlatform;
use Drjele\Doctrine\Type\Exception\InvalidTypeValueException;

abstract class AbstractSetType extends AbstractType
{
    abstract public function getValues(): array;

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null !== $value) {
            $value = (array)$value;

            if ($diff = \array_diff($value, $this->getValues())) {
                throw new InvalidTypeValueException(
                    \sprintf(
                        'invalid value `%s`, expected one of `%s`, for `%s`',
                        \implode(', ', $diff),
                        \implode(', ', $this->getValues()),
                        $this->getName()
                    )
                );
            }

            $value = empty($value) ? '0' : \implode(',', $value);
        }

        return (null === $value) ? null : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?array
    {
        return (null === $value) ? null : \explode(',', $value);
    }

    public function getSqlDeclaration(array $column, AbstractPlatform $platform): string
    {
        $values = [];

        foreach ($this->getValues() as $value) {
            $values[] = $platform->quoteStringLiteral($value);
        }

        if ($platform instanceof MySqlPlatform) {
            return 'SET(' . \implode(',', $values) . ')';
        }

        return $platform->getIntegerTypeDeclarationSQL($column);
    }
}
