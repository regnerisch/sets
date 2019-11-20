<?php

use PHPUnit\Framework\TestCase;
use Regnerisch\Map\BoolMap;
use Regnerisch\Map\DetectTypeMap;
use Regnerisch\Map\DoubleMap;
use Regnerisch\Map\IntegerMap;
use Regnerisch\Map\MixedMap;
use Regnerisch\Map\StringMap;
use Regnerisch\Map\TypeMap;

class MapTest extends TestCase
{
	public function testBoolMap(): void
	{
		$map = new BoolMap([true, false, false, true]);
		$this->assertEquals(
			[true, false, false, true],
			$map->toArray()
		);

		$this->expectException(InvalidArgumentException::class);
		new BoolMap([true, false, 0, true]);
	}

	public function testDetectTypeMap(): void
	{
		$map = new DetectTypeMap([[], [], [], []]);
		$this->assertEquals(
			[[], [], [], []],
			$map->toArray()
		);

		$this->expectException(InvalidArgumentException::class);
		new DetectTypeMap([[], [], '[]', []]);
	}

	public function testDoubleMap(): void
	{
		$map = new DoubleMap([1.1, 1.2, 1.3, 1.4]);
		$this->assertEquals(
			[1.1, 1.2, 1.3, 1.4],
			$map->toArray()
		);

		$this->expectException(InvalidArgumentException::class);
		new DoubleMap([1.1, 1.2, 1.3, 1]);
	}

	public function testIntegerMap(): void
	{
		$map = new IntegerMap([1, 2, 3, 4]);
		$this->assertEquals(
			[1, 2, 3, 4],
			$map->toArray()
		);

		$this->expectException(InvalidArgumentException::class);
		new IntegerMap(['1', 2, 3, 4]);
	}

	public function testMixedMap(): void
	{
		$map = new MixedMap([true, 1.2, 3, 'D']);
		$this->assertEquals(
			[true, 1.2, 3, 'D'],
			$map->toArray()
		);
	}

	public function testStringMap(): void
	{
		$map = new StringMap(['A', 'B', 'C', 'D']);
		$this->assertEquals(
			['A', 'B', 'C', 'D'],
			$map->toArray()
		);

		$this->expectException(InvalidArgumentException::class);
		new StringMap(['A', ['B'], 'C', 'D']);
	}

	public function testTypeMap(): void
	{
		$map = new TypeMap([[], [], [], []], 'array');
		$this->assertEquals(
			[[], [], [], []],
			$map->toArray()
		);

		$this->expectException(InvalidArgumentException::class);
		new TypeMap([[], [], '[]', []], 'array');
	}
}
