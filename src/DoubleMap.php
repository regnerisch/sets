<?php

namespace Regnerisch\Map;

use Regnerisch\Map\Traits\MapHelper;

final class DoubleMap extends Map
{
	use MapHelper;

	public function __construct(array $map)
	{
		$this->addEach($map);
	}

	protected function getType(): ?string
	{
		return 'double';
	}
}
