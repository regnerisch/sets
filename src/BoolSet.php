<?php

namespace Regnerisch\Sets;

use Regnerisch\Sets\Traits\ArrayHelper;

final class BoolSet extends Set
{
	use ArrayHelper;

	public function __construct(array $array)
	{
		$this->addEach($array);
	}

	protected function getType(): ?string
	{
		return 'boolean';
	}
}
