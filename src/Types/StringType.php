<?php

declare(strict_types=1);

namespace Regnerisch\Sets\Types;

use Regnerisch\Sets\Interfaces\TypeInterface;

final class StringType implements TypeInterface
{
    public function validate(iterable $values): bool
    {
        foreach ($values as $value) {
            $this->validateSingle($value);
        }

        return true;
    }

    private function validateSingle(string $value): void
    {
    }
}
