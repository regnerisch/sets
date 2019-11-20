<?php

namespace Regnerisch\Sets;

use Regnerisch\Sets\Traits\ArrayHelper;

final class DoubleSet extends Set
{
	use ArrayHelper;

	public function __construct(array $map)
	{
		$this->addEach($map);
	}

	protected function getType(): ?string
	{
		return 'double';
	}
}
