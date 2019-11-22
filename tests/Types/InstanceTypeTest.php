<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Regnerisch\Sets\Interfaces\TypeInterface;
use Regnerisch\Sets\Set;
use Regnerisch\Sets\Types\BoolType;
use Regnerisch\Sets\Types\InstanceType;

class InstanceTypeTest extends TestCase
{
    public function testArray(): void
    {
        $set = new Set([new BoolType(), new BoolType()], new InstanceType(TypeInterface::class));

        $this->assertEquals(
            [new BoolType(), new BoolType()],
            $set->toArray()
        );
    }

    public function testWrongValue(): void
    {
        $this->expectException(TypeError::class);

        new Set([new BoolType(), new stdClass()], new InstanceType(TypeInterface::class));
    }
}
