<?php

namespace Regnerisch\Sets;

use Regnerisch\Sets\Traits\ArrayHelper;

final class InterfaceSet extends SetAbstract
{
	use ArrayHelper;

	private $type;

	public function __construct(array $array, string $interface)
	{
		$this->type = $interface;
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
				throw new \InvalidArgumentException(sprintf('Invalid type! %s does not implement %s', $itemType, $type));
			}

			$this->map[] = $item;
		}
	}
}
