<?php

namespace Regnerisch\Sets\Traits;

use Regnerisch\Sets\BoolSet;
use Regnerisch\Sets\DoubleSet;
use Regnerisch\Sets\IntegerSet;
use Regnerisch\Sets\Interfaces\SetInterface;
use Regnerisch\Sets\TypeSet;

trait ArrayHelper
{
	public function diff(SetInterface ...$map): self
	{
		$arrays = [];
		foreach ($map as $item) {
			$arrays[] = $item->toArray();
		}

		$map = array_diff($this->map, ...$arrays);

		return $this->instanceFromArray($map);
	}

	public function each(callable $callable): self
	{
		$map = array_map($callable, $this->map);

		return $this->instanceFromArray($map);
	}

	public function filter(callable $callable, int $flag = 0): self
	{
		$map = array_filter($this->map, $callable, $flag);

		return $this->instanceFromArray($map);
	}

	public function get(int $key)
	{
		return $this->map[$key] ?? null;
	}

	public function has($value): bool
	{
		return in_array($value, $this->map, true);
	}

	public function intersect(SetInterface ...$map): self
	{
		$arrays = [];
		foreach ($map as $item) {
			$arrays[] = $item->toArray();
		}

		$map = array_intersect($this->map, ...$arrays);

		return $this->instanceFromArray($map);
	}

	public function pad(int $size, $value): self
	{
		$map = array_pad($this->map, $size, $value);

		return $this->instanceFromArray($map);
	}

	public function push($value): self
	{
		$this->addEach([$value]);

		return $this;
	}

	public function pop()
	{
		return array_pop($this->map);
	}

	public function reverse(): self
	{
		$map = array_reverse($this->map);

		return $this->instanceFromArray($map);
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

		return $this->instanceFromArray($map);
	}

	public function sort(callable $callable): self
	{
		$map = $this->map;

		usort($map, $callable);

		return $this->instanceFromArray($map);
	}

	public function splice(int $offset, ?int $length = null, $replacement = []): self
	{
		$map = $this->map;

		array_splice($map, $offset, $length ?? $this->count(), $replacement);

		return $this->instanceFromArray($map);
	}

	public function shuffle(): self
	{
		$map = $this->map;

		shuffle($map);

		return $this->instanceFromArray($map);
	}

	public function unique(?int $sortFlags = null)
	{
		$map = array_unique($this->map, $sortFlags ?? $this->sortFlag());

		return $this->instanceFromArray($map);
	}

	protected function instanceFromArray(array $array): self
	{
		if (self::class === TypeSet::class) {
			return new self($array, $this->getType());
		}

		return new self($array);
	}

	protected function sortFlag(): int
	{
		switch (self::class) {
			case BoolSet::class:
			case DoubleSet::class:
			case IntegerSet::class:
				return SORT_NUMERIC;
			default:
				return SORT_STRING;
		}
	}
}
