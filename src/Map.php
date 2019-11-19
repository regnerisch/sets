<?php

namespace Regnerisch\Map;

abstract class Map extends ArrayAbstract
{
	abstract protected function getType(): ?string;

	protected function addEach(iterable $map): void
	{
		$type = $this->getType();

		foreach ($map as $item) {
			$itemType = is_object($item) ? get_class($item) : gettype($item);
			if (null === $type || $itemType === $type) {
				$this->map[] = $item;
			} else {
				throw new \InvalidArgumentException(sprintf('Invalid type! Got %s expected %s', $itemType, $type));
			}
		}
	}

	public function add($value): self
	{
		$this->addEach([$value]);

		return $this;
	}

	public function has($value): bool
	{
		return in_array($value, $this->map, true);
	}

	public function remove($value): bool
	{
		$copy = $this->map;

		if (false !== $key = array_search($value, $this->map, true)) {
			unset($copy[$key]);
			$this->map = array_values($copy);
		}

		return true;
	}

	public function toArray(): array
	{
		return $this->map;
	}
}
