<?php

declare(strict_types=1);

namespace Regnerisch\Sets\Types;

use Regnerisch\Sets\Interfaces\TypeInterface;

final class DetectTypeType implements TypeInterface
{
	public function validate(iterable $values): bool
	{
		$detectedType = $this->getTypeFromFirstValue($values);

		foreach ($values as $value) {
			$type = is_object($value) ? get_class($value) : gettype($value);
			if (null !== $type && $type !== $detectedType) {
				throw new \TypeError(sprintf('Arguments must be type of %s, %s given.', $detectedType, $type));
			}
		}

		return true;
	}

	private function getTypeFromFirstValue(iterable $values)
	{
		if (is_array($values)) {
			$array = $values;
		}

		if (is_object($values) && $values instanceof \Traversable) {
			$array = iterator_to_array($values);
		}

		$value = reset($array);

		return is_object($value) ? get_class($value) : gettype($value);
	}
}
