<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Regnerisch\Sets\Set;
use Regnerisch\Sets\Types\BoolType;

class BoolTypeTest extends TestCase
{
    public function testArray(): void
    {
        $set = new Set([true, true, false, false], new BoolType());

        $this->assertEquals(
            [true, true, false, false],
            $set->toArray()
        );
    }

    public function testWrongValue(): void
    {
        $this->expectException(TypeError::class);

        new Set([true, true, false, 1], new BoolType());
    }
}
