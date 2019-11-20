# Map
A simple Library for PHP maps

## Installation
Just run `composer require regnerisch/map`

## Usage
### Map classes
You can use one of the predefined map classes:
```php
$map = new BoolMap([true, false, false, true]);
$map = new DetectTypeMap([[], [], [], []]);
$map = new DoubleMap([1.1, 2.2, 3.3]);
$map = new IntegerMap([1, 2, 3]);
$map = new MixedMap(['A', 1, 1.1]);
$map = new StringMap(['A', 'B', 'C']);
$map = new TypeMap([new MyItem('A'), new MyItem('B')], MyItem::class);
```
If you pass a wrong value, an InvalidArgumentException will be thrown.
When using `DetectTypeMap` the allowed type will be detected automatically from the first value. All following types must match this requirement.

### API
```php
$map->diff($map1, $map2) // same as array_diff
$map->each($callable) // same as array_map
$map->filter($callable) // same as array_filter
$map->get(0) // get value with index 0
$map->has('A') // check whether a value exists
$map->intersect($map1, $map2) // same as array_intersect
$map->pad($size, $defaultValue) // same as array_pad
$map->push($value) // same as array_push
$map->pop() // same as array_pop
$map->reverse() // same as array_reverse
$map->search($value) // same as array_search
$map->shift() // same as array_shift
$map->slice($offset, $length) // same as array_slice
$map->sort($callable) // same as usort
$map->splice($offset, $length, $replacement) // same as array_splice
$map->shuffle() // same as shuffle
$map->unique() // same as array_unique
```
All methods are (if useful or possible) immutable.

### Customize
To create your own map just extend the `Map` class. 
```php
class MyMap extends Map
{
    // Add some base array functionality
    use MapHelper;

    public function __construct(iterable $map) 
    {
        $this->addEach($map);
    }

    protected function getType(): ?string
    {
        return MyType::class
    }
}
```
This creates a map which only allows values from `MyType` class. Now you can add custom functions and extend functionality.

If you use `MapHelper` trait you may also overwrite its `instanceFromArray` method, if your constructor uses another pattern than `__construct(array $array)`
```php
class MyMap extends Map
{
    // Add some base array functionality
    use MapHelper;

    public function __construct(array $array, $customParam1, $customParam2) 
    {
        $this->addEach($array);

        // Do custom things
    }

    protected function getType(): ?string
    {
        return MyType::class
    }

    protected function instanceFromArray(array $array) 
    {
        return new self($array, 'MyCustomParam1', 'MyCustomParam2')
    }
} 
```
## Tests
For running tests just clone the repository, than run `composer install` and `composer tests`.
