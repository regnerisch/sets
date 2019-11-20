<?php

namespace Regnerisch\Map;

use Regnerisch\Map\Traits\MapHelper;

final class BoolMap extends Map
{
	use MapHelper;

	public function __construct(array $array)
	{
		$this->addEach($array);
	}

	protected function getType(): ?string
	{
		return 'boolean';
	}
}
