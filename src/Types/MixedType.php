<?php

declare(strict_types=1);

namespace Regnerisch\Sets\Types;

use Regnerisch\Sets\Interfaces\TypeInterface;

final class MixedType implements TypeInterface
{
	public function validate(iterable $values): bool
	{
		return true;
	}
}
