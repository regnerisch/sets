<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Regnerisch\Sets\Set;
use Regnerisch\Sets\Types\DetectTypeType;
use Regnerisch\Sets\Types\MixedType;

class DetectTypeTypeTest extends TestCase
{
	public function testArrayDetectString(): void
	{
		$set = new Set(['A', 'B', 'C', 'D'], new DetectTypeType());

		$this->assertEquals(
			['A', 'B', 'C', 'D'],
			$set->toArray()
		);
	}

	public function testArrayDetectInteger(): void
	{
		$set = new Set([1, 2, 3, 4], new DetectTypeType());

		$this->assertEquals(
			[1, 2, 3, 4],
			$set->toArray()
		);
	}

	public function testArrayDetectClass(): void
	{
		$set = new Set([new stdClass(), new stdClass()], new DetectTypeType());

		$this->assertEquals(
			[new stdClass(), new stdClass()],
			$set->toArray()
		);
	}

	public function testArrayDetectTraversable(): void
	{
		$set = new Set(new Set(['A', 'B', 'C', 'D'], new MixedType()), new DetectTypeType());

		$this->assertEquals(
			['A', 'B', 'C', 'D'],
			$set->toArray()
		);
	}

	public function testWrongValueDetectString(): void
	{
		$this->expectException(TypeError::class);

		new Set(['A', 'B', 'C', 1], new DetectTypeType());
	}

	public function testWrongValueDetectInteger(): void
	{
		$this->expectException(TypeError::class);

		new Set([1, 2, 3, 4.0], new DetectTypeType());
	}

	public function testWrongValueDetectClass(): void
	{
		$this->expectException(TypeError::class);

		new Set([new stdClass(), new DetectTypeType()], new DetectTypeType());
	}

	public function testWrongValueDetectTraversable(): void
	{
		$this->expectException(TypeError::class);

		new Set(new Set(['A', 'B', 'C', 1], new MixedType()), new DetectTypeType());
	}
}
