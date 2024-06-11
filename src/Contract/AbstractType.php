<?php

declare(strict_types=1);

/*
 * Copyright (c) Adrian Jeledintan
 */

namespace Drjele\Doctrine\Type\Contract;

use Doctrine\DBAL\Types\Type;
use ReflectionClass;

abstract class AbstractType extends Type
{
    public function getName(): string
    {
        return (new ReflectionClass(static::class))->getShortName();
    }
}
