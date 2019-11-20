<?php

use PHPUnit\Framework\TestCase;
use Regnerisch\Sets\StringSet;
use Regnerisch\Sets\TypeSet;

class ArrayHelperTest extends TestCase
{
	public function testDiff()
	{
		$map = new StringSet(['A', 'B', 'C', 'D']);
		$map1 = new StringSet(['A', 'C']);
		$map2 = new StringSet(['D']);

		$this->assertEquals(
			['B', 'D'],
			$map->diff($map1)->toArray()
		);

		$this->assertEquals(
			['B'],
			$map->diff($map1, $map2)->toArray()
		);
	}

	public function testEach()
	{
		$map = new StringSet(['A', 'B', 'C', 'D']);

		$newMap = $map->each(static function ($item) {
			return '_' . $item . '_';
		});

		$this->assertInstanceOf(StringSet::class, $newMap);

		$this->assertEquals(
			['A', 'B', 'C', 'D'],
			$map->toArray()
		);

		$this->assertEquals(
			['_A_', '_B_', '_C_', '_D_'],
			$newMap->toArray()
		);

		// ---

		$map = new TypeSet([1, 2, 3, 4], 'integer');

		$newMap = $map->each(static function ($item) {
			return $item * 2;
		});

		$this->assertInstanceOf(TypeSet::class, $newMap);

		$this->assertEquals(
			[1, 2, 3, 4],
			$map->toArray()
		);

		$this->assertEquals(
			[2, 4, 6, 8],
			$newMap->toArray()
		);
	}

	public function testFilter()
	{
		$map = new StringSet(['A', 'B', 'C', 'D']);

		$newMap = $map->filter(static function ($item) {
			return in_array($item, ['A', 'D']);
		});

		$this->assertInstanceOf(StringSet::class, $newMap);

		$this->assertEquals(
			['A', 'B', 'C', 'D'],
			$map->toArray()
		);

		$this->assertEquals(
			['A', 'D'],
			$newMap->toArray()
		);

		// ---

		$map = new TypeSet([1, 2, 3, 4], 'integer');

		$newMap = $map->filter(static function ($item) {
			return 0 === $item % 2;
		});

		$this->assertInstanceOf(TypeSet::class, $newMap);

		$this->assertEquals(
			[1, 2, 3, 4],
			$map->toArray()
		);

		$this->assertEquals(
			[2, 4],
			$newMap->toArray()
		);
	}

	public function testGet()
	{
		$map = new StringSet(['A', 'B', 'C', 'D']);

		$this->assertEquals(
			'A',
			$map->get(0)
		);
	}

	public function testHas()
	{
		$map = new StringSet(['A', 'B', 'C', 'D']);

		$this->assertTrue($map->has('A'));
		$this->assertFalse($map->has('E'));
	}

	public function testIntersect()
	{
		$map = new StringSet(['A', 'B', 'C', 'D']);
		$map1 = new StringSet(['A', 'C']);
		$map2 = new StringSet(['A']);

		$this->assertEquals(
			['A', 'C'],
			$map->intersect($map1)->toArray()
		);

		$this->assertEquals(
			['A'],
			$map->intersect($map1, $map2)->toArray()
		);
	}

	public function testPad()
	{
		$map = new StringSet(['A', 'B']);

		$this->assertEquals(
			['A', 'B', 'C', 'C'],
			$map->pad(4, 'C')->toArray()
		);

		$this->assertEquals(
			['C', 'C', 'A', 'B'],
			$map->pad(-4, 'C')->toArray()
		);
	}

	public function testPush()
	{
		$map = new StringSet(['A', 'B', 'C']);
		$map->push('D');

		$this->assertEquals(
			['A', 'B', 'C', 'D'],
			$map->toArray()
		);

		$this->expectException(InvalidArgumentException::class);
		$map->push(1);
	}

	public function testPop()
	{
		$map = new StringSet(['A', 'B', 'C', 'D']);

		$this->assertEquals(
			'D',
			$map->pop()
		);

		$this->assertEquals(
			['A', 'B', 'C'],
			$map->toArray()
		);
	}

	public function testReverse()
	{
		$map = new StringSet(['A', 'B', 'C', 'D']);

		$this->assertEquals(
			['D', 'C', 'B', 'A'],
			$map->reverse()->toArray()
		);
	}

	public function testSearch()
	{
		$map = new StringSet(['A', 'B', 'C', 'D']);

		$this->assertEquals(
			2,
			$map->search('C')
		);
	}

	public function testShift()
	{
		$map = new StringSet(['A', 'B', 'C', 'D']);

		$this->assertEquals(
			'A',
			$map->shift()
		);
	}

	public function testSlice()
	{
		$map = new StringSet(['A', 'B', 'C', 'D']);

		$this->assertEquals(
			['C', 'D'],
			$map->slice(2)->toArray()
		);

		$this->assertEquals(
			['B', 'C'],
			$map->slice(-3, 2)->toArray()
		);
	}

	public function testSort()
	{
		$map = new StringSet(['A', 'B', 'C', 'D']);

		$this->assertEquals(
			['D', 'C', 'B', 'A'],
			$map->sort(static function ($a, $b) {
				return -1 * strcmp($a, $b);
			})->toArray()
		);
	}

	public function testSplice()
	{
		$map = new StringSet(['A', 'B', 'C', 'D']);

		$this->assertEquals(
			['A', 'E', 'F', 'D'],
			$map->splice(1, 2, ['E', 'F'])->toArray()
		);
	}

	public function shuffle()
	{
		$map = new StringSet(['A', 'B', 'C', 'D']);

		$this->assertIsArray($map->toArray());
	}

	public function testUnique()
	{
		$map = new StringSet(['A', 'B', 'C', 'D', 'A']);

		$this->assertEquals(
			['A', 'B', 'C', 'D'],
			$map->unique()->toArray()
		);
	}
}
