<?php

namespace Regnerisch\Sets;

use Regnerisch\Sets\Interfaces\SetInterface;

abstract class Set extends ArrayAbstract implements SetInterface
{
	abstract protected function getType(): ?string;

	protected function addEach(array $map): void
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

	protected function setEach(array $map): void
	{
		$this->map = [];
		$this->addEach($map);
	}

	public function toArray(): array
	{
		return $this->map;
	}
}
