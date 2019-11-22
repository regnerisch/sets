<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Regnerisch\Sets\Set;
use Regnerisch\Sets\Types\ArrayType;

class ArrayTypeTest extends TestCase
{
    public function testArray(): void
    {
        $set = new Set([['a', 1, 1.4], [], [true, new stdClass()], []], new ArrayType());

        $this->assertEquals(
            [['a', 1, 1.4], [], [true, new stdClass()], []],
            $set->toArray()
        );
    }

    public function testWrongValue(): void
    {
        $this->expectException(TypeError::class);

        new Set([['a', 1, 1.4], [], [true, new stdClass()], '[]'], new ArrayType());
    }
}
