<?php

namespace Regnerisch\Map;

use Regnerisch\Map\Traits\MapHelper;

final class TypeMap extends Map
{
	use MapHelper;

	private $type;

	public function __construct(array $array, string $type)
	{
		$this->type = $type;
		$this->addEach($array);
	}

	protected function getType(): string
	{
		return $this->type;
	}
}
