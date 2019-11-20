# Sets
A simple library for typesafe PHP arrays 

## Installation
Just run `composer require regnerisch/sets`

## Usage
### Set classes
You can use one of the predefined set classes:
```php
$set = new BoolSet([true, false, false, true]);
$set = new DetectTypeSet([[], [], [], []]);
$set = new DoubleSet([1.1, 2.2, 3.3]);
$set = new IntegerSet([1, 2, 3]);
$set = new InstanceSet([new Car(), new Ship(), new Plane()], Transport::class);
$set = new MixedSet(['A', 1, 1.1]);
$set = new StringSet(['A', 'B', 'C']);
$set = new TypeSet([new MyItem('A'), new MyItem('B')], MyItem::class);
```
If you pass a wrong value, an `InvalidArgumentException` will be thrown.
When using `DetectTypeSet` the allowed type will be detected automatically from the first value. All following types must match this requirement.

### API
```php
$set->diff($set1, $set2) // same as array_diff
$set->each($callable) // same as array_map
$set->filter($callable) // same as array_filter
$set->get(0) // get value with index 0
$set->has('A') // check whether a value exists
$set->intersect($set1, $set2) // same as array_intersect
$set->pad($size, $defaultValue) // same as array_pad
$set->push($value) // same as array_push
$set->pop() // same as array_pop
$set->reverse() // same as array_reverse
$set->search($value) // same as array_search
$set->shift() // same as array_shift
$set->slice($offset, $length) // same as array_slice
$set->sort($callable) // same as usort
$set->splice($offset, $length, $replacement) // same as array_splice
$set->shuffle() // same as shuffle
$set->unique() // same as array_unique
```
All methods are (if useful or possible) immutable.

### Customize
To create your own set just extend the `Set` class. 
```php
class MySet extends Set
{
    // Add some base array functionality
    use ArrayHelper;

    public function __construct(array $array) 
    {
        $this->addEach($array);
    }

    protected function getType(): ?string
    {
        return MyType::class;
    }
}
```
This creates a set which only allows values from `MyType` class. Now you can add custom functions and extend functionality.

If you use `ArrayHelper` trait you may also overwrite its `instanceFromArray` method, if your constructor uses another pattern than `__construct(array $array)`
```php
class MySet extends Set
{
    // Add some base array functionality
    use ArrayHelper;

    public function __construct(array $array, $customParam1, $customParam2) 
    {
        $this->addEach($array);

        // Do custom things
    }

    protected function getType(): ?string
    {
        return MyType::class;
    }

    protected function instanceFromArray(array $array) 
    {
        return new self($array, $this->myCustomParam1, 'MyCustomParam2');
    }
} 
```
## Tests
For running tests just clone the repository, than run `composer install` and `composer tests`.
