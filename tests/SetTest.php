<?php

use PHPUnit\Framework\TestCase;
use Regnerisch\Sets\BoolSet;
use Regnerisch\Sets\DetectTypeSet;
use Regnerisch\Sets\DoubleSet;
use Regnerisch\Sets\IntegerSet;
use Regnerisch\Sets\MixedSet;
use Regnerisch\Sets\StringSet;
use Regnerisch\Sets\TypeSet;

class SetTest extends TestCase
{
	public function testBoolSet(): void
	{
		$map = new BoolSet([true, false, false, true]);
		$this->assertEquals(
			[true, false, false, true],
			$map->toArray()
		);

		$this->expectException(InvalidArgumentException::class);
		new BoolSet([true, false, 0, true]);
	}

	public function testDetectTypeSet(): void
	{
		$map = new DetectTypeSet([[], [], [], []]);
		$this->assertEquals(
			[[], [], [], []],
			$map->toArray()
		);

		$map = new DetectTypeSet([]);
		$this->assertNull($map->getType());

		$this->expectException(InvalidArgumentException::class);
		new DetectTypeSet([[], [], '[]', []]);
	}

	public function testDoubleSet(): void
	{
		$map = new DoubleSet([1.1, 1.2, 1.3, 1.4]);
		$this->assertEquals(
			[1.1, 1.2, 1.3, 1.4],
			$map->toArray()
		);

		$this->expectException(InvalidArgumentException::class);
		new DoubleSet([1.1, 1.2, 1.3, 1]);
	}

	public function testIntegerSet(): void
	{
		$map = new IntegerSet([1, 2, 3, 4]);
		$this->assertEquals(
			[1, 2, 3, 4],
			$map->toArray()
		);

		$this->expectException(InvalidArgumentException::class);
		new IntegerSet(['1', 2, 3, 4]);
	}

	public function testMixedSet(): void
	{
		$map = new MixedSet([true, 1.2, 3, 'D']);
		$this->assertEquals(
			[true, 1.2, 3, 'D'],
			$map->toArray()
		);
	}

	public function testStringSet(): void
	{
		$map = new StringSet(['A', 'B', 'C', 'D']);
		$this->assertEquals(
			['A', 'B', 'C', 'D'],
			$map->toArray()
		);

		$this->expectException(InvalidArgumentException::class);
		new StringSet(['A', ['B'], 'C', 'D']);
	}

	public function testTypeSet(): void
	{
		$map = new TypeSet([[], [], [], []], 'array');
		$this->assertEquals(
			[[], [], [], []],
			$map->toArray()
		);

		$this->expectException(InvalidArgumentException::class);
		new TypeSet([[], [], '[]', []], 'array');
	}
}
