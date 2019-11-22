<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Regnerisch\Sets\Set;
use Regnerisch\Sets\Types\IntegerType;
use Regnerisch\Sets\Types\StringType;

class SetTest extends TestCase
{
    public function testCount(): void
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            4,
            $map->count()
        );
    }

    public function testDiff(): void
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());
        $map1 = new Set(['A', 'C'], new StringType());
        $map2 = new Set(['D'], new StringType());

        $this->assertEquals(
            ['B', 'D'],
            $map->diff($map1)->toArray()
        );

        $this->assertEquals(
            ['B'],
            $map->diff($map1, $map2)->toArray()
        );
    }

    public function testEach(): void
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());

        $newMap = $map->each(static function ($item) {
            return '_' . $item . '_';
        });

        $this->assertEquals(
            ['A', 'B', 'C', 'D'],
            $map->toArray()
        );

        $this->assertEquals(
            ['_A_', '_B_', '_C_', '_D_'],
            $newMap->toArray()
        );
    }

    public function testFilter(): void
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());

        $newMap = $map->filter(static function ($item) {
            return in_array($item, ['A', 'D']);
        });

        $this->assertEquals(
            ['A', 'B', 'C', 'D'],
            $map->toArray()
        );

        $this->assertEquals(
            ['A', 'D'],
            $newMap->toArray()
        );
    }

    public function testGet(): void
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            'A',
            $map->get(0)
        );
    }

    public function testHas(): void
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertTrue($map->has('A'));
        $this->assertFalse($map->has('E'));
    }

    public function testImplode(): void
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            'ABCD',
            $map->implode()
        );

        $this->assertEquals(
            'A_B_C_D',
            $map->implode('_')
        );
    }

    public function testIntersect(): void
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());
        $map1 = new Set(['A', 'C'], new StringType());
        $map2 = new Set(['A'], new StringType());

        $this->assertEquals(
            ['A', 'C'],
            $map->intersect($map1)->toArray()
        );

        $this->assertEquals(
            ['A'],
            $map->intersect($map1, $map2)->toArray()
        );
    }

    public function testPad(): void
    {
        $map = new Set(['A', 'B'], new StringType());

        $this->assertEquals(
            ['A', 'B', 'C', 'C'],
            $map->pad(4, 'C')->toArray()
        );

        $this->assertEquals(
            ['C', 'C', 'A', 'B'],
            $map->pad(-4, 'C')->toArray()
        );
    }

    public function testPush(): void
    {
        $map = new Set(['A', 'B', 'C'], new StringType());
        $map->push('D');

        $this->assertEquals(
            ['A', 'B', 'C', 'D'],
            $map->toArray()
        );

        $this->expectException(TypeError::class);
        $map->push(1);
    }

    public function testPop(): void
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            'D',
            $map->pop()
        );

        $this->assertEquals(
            ['A', 'B', 'C'],
            $map->toArray()
        );
    }

    public function testReduce(): void
    {
        $map = new Set([1, 2, 3, 4], new IntegerType());

        $value = $map->reduce(static function ($carry, $item) {
            return $carry * $item;
        }, 10);

        $this->assertEquals(
            240,
            $value
        );
    }

    public function testReverse(): void
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            ['D', 'C', 'B', 'A'],
            $map->reverse()->toArray()
        );
    }

    public function testSearch(): void
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            2,
            $map->search('C')
        );
    }

    public function testShift(): void
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            'A',
            $map->shift()
        );
    }

    public function testSlice(): void
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            ['C', 'D'],
            $map->slice(2)->toArray()
        );

        $this->assertEquals(
            ['B', 'C'],
            $map->slice(-3, 2)->toArray()
        );
    }

    public function testSort(): void
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            ['D', 'C', 'B', 'A'],
            $map->sort(static function ($a, $b) {
                return -1 * strcmp($a, $b);
            })->toArray()
        );
    }

    public function testSplice(): void
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            ['A', 'E', 'F', 'D'],
            $map->splice(1, 2, ['E', 'F'])->toArray()
        );
    }

    public function shuffle(): void
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertIsArray($map->toArray());
    }

    public function testUnique(): void
    {
        $map = new Set(['A', 'B', 'C', 'D', 'A'], new StringType());

        $this->assertEquals(
            ['A', 'B', 'C', 'D'],
            $map->unique()->toArray()
        );
    }

    public function testWalk(): void
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());

        $map->walk(static function (&$item, $index) {
            $item = '_' . $item . '_';
        });

        $this->assertEquals(
            ['_A_', '_B_', '_C_', '_D_'],
            $map->toArray()
        );
    }

    public function testToJson()
    {
        $map = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            '["A","B","C","D"]',
            $map->toJson()
        );
    }
}
