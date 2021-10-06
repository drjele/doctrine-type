<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use ReflectionClass;

abstract class AbstractType extends Type
{
    final public static function getDefaultName(): string
    {
        return (new ReflectionClass(static::class))->getShortName();
    }

    final public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }

    final public function getName(): string
    {
        return static::getDefaultName();
    }
}
