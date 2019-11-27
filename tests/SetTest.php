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
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            4,
            $set->count()
        );
    }

    public function testChunk(): void
    {
        $set = new Set(['A', 'B', 'C', 'D', 'E'], new StringType());

        $newSet = $set->chunk(2);

        $this->assertEquals(
            [
                new Set(['A', 'B'], new StringType()),
                new Set(['C', 'D'], new StringType()),
                new Set(['E'], new StringType()),
            ],
            $newSet->toArray()
        );
    }

    public function testDiff(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());
        $set1 = new Set(['A', 'C'], new StringType());
        $set2 = new Set(['D'], new StringType());

        $this->assertEquals(
            ['B', 'D'],
            $set->diff($set1)->toArray()
        );

        $this->assertEquals(
            ['B'],
            $set->diff($set1, $set2)->toArray()
        );
    }

    public function testEach(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $newMap = $set->each(static function ($item) {
            return '_' . $item . '_';
        });

        $this->assertEquals(
            ['A', 'B', 'C', 'D'],
            $set->toArray()
        );

        $this->assertEquals(
            ['_A_', '_B_', '_C_', '_D_'],
            $newMap->toArray()
        );
    }

    public function testFilter(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $newMap = $set->filter(static function ($item) {
            return \in_array($item, ['A', 'D']);
        });

        $this->assertEquals(
            ['A', 'B', 'C', 'D'],
            $set->toArray()
        );

        $this->assertEquals(
            ['A', 'D'],
            $newMap->toArray()
        );
    }

    public function testFirst(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            'A',
            $set->first()
        );

        $this->assertEquals(
            ['A', 'B', 'C', 'D'],
            $set->toArray()
        );
    }

    public function testGet(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            'A',
            $set->get(0)
        );
    }

    public function testHas(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertTrue($set->has('A'));
        $this->assertFalse($set->has('E'));
    }

    public function testImplode(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            'ABCD',
            $set->implode()
        );

        $this->assertEquals(
            'A_B_C_D',
            $set->implode('_')
        );
    }

    public function testIntersect(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());
        $set1 = new Set(['A', 'C'], new StringType());
        $set2 = new Set(['A'], new StringType());

        $this->assertEquals(
            ['A', 'C'],
            $set->intersect($set1)->toArray()
        );

        $this->assertEquals(
            ['A'],
            $set->intersect($set1, $set2)->toArray()
        );
    }

    public function testLast(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            'D',
            $set->last()
        );

        $this->assertEquals(
            ['A', 'B', 'C', 'D'],
            $set->toArray()
        );
    }

    public function testPad(): void
    {
        $set = new Set(['A', 'B'], new StringType());

        $this->assertEquals(
            ['A', 'B', 'C', 'C'],
            $set->pad(4, 'C')->toArray()
        );

        $this->assertEquals(
            ['C', 'C', 'A', 'B'],
            $set->pad(-4, 'C')->toArray()
        );
    }

    public function testPush(): void
    {
        $set = new Set(['A', 'B', 'C'], new StringType());
        $set->push('D');

        $this->assertEquals(
            ['A', 'B', 'C', 'D'],
            $set->toArray()
        );

        $this->expectException(TypeError::class);
        $set->push(1);
    }

    public function testPop(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            'D',
            $set->pop()
        );

        $this->assertEquals(
            ['A', 'B', 'C'],
            $set->toArray()
        );
    }

    public function testReduce(): void
    {
        $set = new Set([1, 2, 3, 4], new IntegerType());

        $value = $set->reduce(static function ($carry, $item) {
            return $carry * $item;
        }, 10);

        $this->assertEquals(
            240,
            $value
        );
    }

    public function testReverse(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            ['D', 'C', 'B', 'A'],
            $set->reverse()->toArray()
        );
    }

    public function testSearch(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            2,
            $set->search('C')
        );
    }

    public function testShift(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            'A',
            $set->shift()
        );
    }

    public function testShuffle(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $newSet = $set->shuffle();

        $this->assertContains(
            'A',
            $newSet->toArray()
        );

        $this->assertContains(
            'B',
            $newSet->toArray()
        );

        $this->assertContains(
            'C',
            $newSet->toArray()
        );

        $this->assertContains(
            'D',
            $newSet->toArray()
        );
    }

    public function testSlice(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            ['C', 'D'],
            $set->slice(2)->toArray()
        );

        $this->assertEquals(
            ['B', 'C'],
            $set->slice(-3, 2)->toArray()
        );
    }

    public function testSort(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            ['D', 'C', 'B', 'A'],
            $set->sort(static function ($a, $b) {
                return -1 * \strcmp($a, $b);
            })->toArray()
        );
    }

    public function testSplice(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            ['A', 'E', 'F', 'D'],
            $set->splice(1, 2, ['E', 'F'])->toArray()
        );
    }

    public function shuffle(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertIsArray($set->toArray());
    }

    public function testUnique(): void
    {
        $set = new Set(['A', 'B', 'C', 'D', 'A'], new StringType());

        $this->assertEquals(
            ['A', 'B', 'C', 'D'],
            $set->unique()->toArray()
        );
    }

    public function testWalk(): void
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $set->walk(static function (&$item, $index) {
            $item = '_' . $item . '_';
        });

        $this->assertEquals(
            ['_A_', '_B_', '_C_', '_D_'],
            $set->toArray()
        );
    }

    public function testToJson()
    {
        $set = new Set(['A', 'B', 'C', 'D'], new StringType());

        $this->assertEquals(
            '["A","B","C","D"]',
            $set->toJson()
        );
    }
}
