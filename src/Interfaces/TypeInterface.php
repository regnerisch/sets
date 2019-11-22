<?php

declare(strict_types=1);

namespace Regnerisch\Sets\Interfaces;

interface TypeInterface
{
    public function validate(iterable $values): bool;
}
