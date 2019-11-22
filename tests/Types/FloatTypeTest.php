<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Regnerisch\Sets\Set;
use Regnerisch\Sets\Types\FloatType;

class FloatTypeTest extends TestCase
{
    public function testArray(): void
    {
        $set = new Set([1.0, 1.1, 1.2, 1.3, 2], new FloatType());

        $this->assertEquals(
            [1.0, 1.1, 1.2, 1.3, 2],
            $set->toArray()
        );
    }

    public function testWrongValue(): void
    {
        $this->expectException(TypeError::class);

        new Set([1.0, 1.1, 1.2, '2'], new FloatType());
    }
}
