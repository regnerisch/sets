<?php

namespace Regnerisch\Sets;

use Regnerisch\Sets\Traits\ArrayHelper;

final class InstanceSet extends Set
{
	use ArrayHelper;

	private $type;

	public function __construct(array $array, string $instance)
	{
		$this->type = $instance;
		$this->addEach($array);
	}

	protected function getType(): string
	{
		return $this->type;
	}

	protected function addEach(array $map): void
	{
		$type = $this->getType();

		foreach ($map as $item) {
			$itemType = is_object($item) ? get_class($item) : gettype($item);
			if (null !== $type && !$item instanceof $type) {
				throw new \InvalidArgumentException(sprintf('Invalid type! %s is not an instance of %s', $itemType, $type));
			}

			$this->map[] = $item;
		}
	}
}
