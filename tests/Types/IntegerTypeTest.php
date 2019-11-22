<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Regnerisch\Sets\Set;
use Regnerisch\Sets\Types\IntegerType;

class IntegerTypeTest extends TestCase
{
    public function testArray(): void
    {
        $set = new Set([1, 2, 3, 4], new IntegerType());

        $this->assertEquals(
            [1, 2, 3, 4],
            $set->toArray()
        );
    }

    public function testWrongValue(): void
    {
        $this->expectException(TypeError::class);

        new Set([1, 2, 3, 4.0], new IntegerType());
    }
}
