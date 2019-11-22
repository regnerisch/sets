<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Regnerisch\Sets\Set;
use Regnerisch\Sets\Types\MixedType;

class MixedTypeTest extends TestCase
{
    public function testArray(): void
    {
        $set = new Set([[], true, 1, 1.2, 'A'], new MixedType());

        $this->assertEquals(
            [[], true, 1, 1.2, 'A'],
            $set->toArray()
        );
    }
}
