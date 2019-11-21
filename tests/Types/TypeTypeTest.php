<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Regnerisch\Sets\Set;
use Regnerisch\Sets\Types\TypeType;

class TypeTypeTest extends TestCase
{
	public function testArray(): void
	{
		$set = new Set(['A', 'B', 'C', 'D'], new TypeType('string'));

		$this->assertEquals(
			['A', 'B', 'C', 'D'],
			$set->toArray()
		);
	}

	public function testWrongValue(): void
	{
		$this->expectException(TypeError::class);

		new Set([new stdClass(), 'A'], new TypeType(stdClass::class));
	}
}
