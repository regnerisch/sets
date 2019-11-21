<?php

declare(strict_types=1);

namespace Regnerisch\Sets\Types;

use Regnerisch\Sets\Interfaces\TypeInterface;

final class TypeType implements TypeInterface
{
	private $type;

	public function __construct(string $type)
	{
		$this->type = $type;
	}

	public function validate(iterable $values): bool
	{
		foreach ($values as $value) {
			$type = is_object($value) ? get_class($value) : gettype($value);
			if ($type !== $this->type) {
				throw new \TypeError(sprintf('Arguments must be type of %s, %s given.', $this->type, $type));
			}
		}

		return true;
	}
}
