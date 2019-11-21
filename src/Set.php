<?php

declare(strict_types=1);

namespace Regnerisch\Sets;

use Regnerisch\Sets\Interfaces\SetInterface;
use Regnerisch\Sets\Interfaces\TypeInterface;

class Set implements \IteratorAggregate, \Countable, SetInterface
{
	protected $map = [];
	protected $type;

	public function __construct(iterable $iterable, TypeInterface $type)
	{
		$this->type = $type;

		if ($type->validate($iterable)) {
			foreach ($iterable as $value) {
				$this->map[] = $value;
			}
		}
	}

	public function count()
	{
		return count($this->map);
	}

	public function diff(SetInterface ...$map): self
	{
		$arrays = [];
		foreach ($map as $item) {
			$arrays[] = $item->toArray();
		}

		$map = array_diff($this->map, ...$arrays);

		return new self($map, $this->type);
	}

	public function each(callable $callable): self
	{
		$map = array_map($callable, $this->map);

		return new self($map, $this->type);
	}

	public function filter(callable $callable, int $flag = 0): self
	{
		$map = array_filter($this->map, $callable, $flag);

		return new self($map, $this->type);
	}

	public function get(int $key)
	{
		return $this->map[$key] ?? null;
	}

	public function has($value): bool
	{
		return in_array($value, $this->map, true);
	}

	public function implode(string $glue = '')
	{
		return implode($glue, $this->map);
	}

	public function intersect(SetInterface ...$map): self
	{
		$arrays = [];
		foreach ($map as $item) {
			$arrays[] = $item->toArray();
		}

		$map = array_intersect($this->map, ...$arrays);

		return new self($map, $this->type);
	}

	public function pad(int $size, $value): self
	{
		$map = array_pad($this->map, $size, $value);

		return new self($map, $this->type);
	}

	public function push($value): self
	{
		if ($this->type->validate([$value])) {
			$this->map[] = $value;
		}

		return $this;
	}

	public function pop()
	{
		return array_pop($this->map);
	}

	public function reduce(callable $callable, $initial = null)
	{
		return array_reduce($this->map, $callable, $initial);
	}

	public function reverse(): self
	{
		$map = array_reverse($this->map);

		return new self($map, $this->type);
	}

	public function search($value): int
	{
		return array_search($value, $this->map, true);
	}

	public function shift()
	{
		return array_shift($this->map);
	}

	public function slice(int $offset, ?int $length = null): self
	{
		$map = array_slice($this->map, $offset, $length);

		return new self($map, $this->type);
	}

	public function sort(callable $callable): self
	{
		$map = $this->map;

		usort($map, $callable);

		return new self($map, $this->type);
	}

	public function splice(int $offset, ?int $length = null, $replacement = []): self
	{
		$map = $this->map;

		array_splice($map, $offset, $length ?? $this->count(), $replacement);

		return new self($map, $this->type);
	}

	public function shuffle(): self
	{
		$map = $this->map;

		shuffle($map);

		return new self($map, $this->type);
	}

	public function unique(int $sortFlags = SORT_STRING)
	{
		$map = array_unique($this->map, $sortFlags);

		return new self($map, $this->type);
	}

	public function walk(callable $callable, $userdata = null): bool
	{
		return array_walk($this->map, $callable, $userdata);
	}

	public function toArray(): array
	{
		return $this->map;
	}

	public function toJson(int $options = 0, int $depth = 512): string
	{
		return json_encode($this->map, $options, $depth);
	}

	public function getIterator()
	{
		return new \ArrayIterator($this->map);
	}
}
