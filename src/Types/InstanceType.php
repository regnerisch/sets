<?php

declare(strict_types=1);

namespace Regnerisch\Sets\Types;

use Regnerisch\Sets\Interfaces\TypeInterface;

final class InstanceType implements TypeInterface
{
	private $instance;

	public function __construct(string $instance)
	{
		$this->instance = $instance;
	}

	public function validate(iterable $values): bool
	{
		foreach ($values as $value) {
			if (!is_object($value) || !$value instanceof $this->instance) {
				$type = is_object($value) ? get_class($value) : gettype($value);
				throw new \TypeError(sprintf('%s must be an instance of %s', $type, $this->instance));
			}
		}

		return true;
	}
}
