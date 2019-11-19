# Map
A simple Library for PHP maps

## Usage
### Maps
You can use one of the predefined map classes:
```php
$map = new DoubleMap([1.1, 2.2, 3.3]);
$map = new IntegerMap([1, 2, 3]);
$map = new MixedMap(['A', 1, 1.1]);
$map = new StringMap(['A', 'B', 'C']);
$map = new TypeMap([new MyItem('A'), new MyItem('B')], MyItem::class);
```
If you pass a wrong value, an InvalidArgumentException will be thrown.

### API
```php
$map->add($value); // Adds a new value to the map, throws InvalidArgumentException if value is not compatible with map
$map->has($value); // Check whether the given values exists in the map
$map->remove($value); // Removes the given value from the map
$map->count(); // Returns the number of values in the map
```

### Customize
To create your own map just extend the `Map` class. 
```php
class MyMap extends Map
{
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
