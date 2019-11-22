# Sets
[![Build Status](https://travis-ci.org/regnerisch/sets.svg?branch=master)](https://travis-ci.org/regnerisch/sets)
[![codecov](https://codecov.io/gh/regnerisch/sets/branch/master/graph/badge.svg)](https://codecov.io/gh/regnerisch/sets)

A simple library for typesafe PHP arrays 

## Installation
Just run `composer require regnerisch/sets`

## Usage
### Set types
You can use one of the predefined set types:
```php
$set = new Set([[], [], []], new ArrayType());
$set = new Set([true, false, false], new BoolType());
$set = new Set([[], [], []], new DetectTypeType());
$set = new Set([1.1, 2.2, 3.3], new FloatType());
$set = new Set([1, 2, 3], new IntegerType());
$set = new Set([new Car(), new Ship(), new Plane()], new InstanceType(Transport::class));
$set = new Set(['A', 1, 1.1], new MixedType());
$set = new Set(['A', 'B', 'C'], new StringType());
$set = new Set([new MyItem('A'), new MyItem('B')], new TypeType(MyItem::class));
```
If you pass a wrong value, a `TypeError` will be thrown.
When using `DetectTypeType` the allowed type will be detected automatically from the first value. All following types must match this requirement.

### API
```php
$set->chunk($size) // same as array_chunk
$set->diff($set1, $set2) // same as array_diff
$set->each($callable) // same as array_map
$set->filter($callable) // same as array_filter
$set->first() // returns first value of set
$set->get(4) // get value with index 4
$set->has('A') // check whether a value exists
$set->implode($glue) // same as implode
$set->intersect($set1, $set2) // same as array_intersect
$set->last() // returns last value of set
$set->pad($size, $defaultValue) // same as array_pad
$set->push($value) // same as array_push
$set->pop() // same as array_pop
$set->reduce($callable, $initial) // same as array_reduce
$set->reverse() // same as array_reverse
$set->search($value) // same as array_search
$set->shift() // same as array_shift
$set->slice($offset, $length) // same as array_slice
$set->sort($callable) // same as usort
$set->splice($offset, $length, $replacement) // same as array_splice
$set->shuffle() // same as shuffle
$set->unique() // same as array_unique
$set->walk($callable, $userdata) // same as array_walk

// Special functions
$set->toArray()
$set->toJson()
```
All methods are (if useful or possible) immutable.

### Customize
To create your own `SetType` just implement `TypeInterface` interface. 
```php
class MySetType implements TypeInterface
{
    public function validate(iterable $values): bool
    {
        foreach ($values as $value) {
            if ($value instanceof MyRestrictedClass::class) {
                throw new TypeError();
            }
        }

        return true;
    }
}
```
This creates a `SetType` which only allows values from `MyRestrictedClass` class. You can than use it with `Set`:
```php
new Set($arrayWithMyRestrictedClasses, new MySetType());
```

## Tests
For running tests just clone the repository, than run `composer install` and `composer tests`.
