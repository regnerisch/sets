<?php

namespace Regnerisch\Map;

use Regnerisch\Map\Traits\MapHelper;

final class DetectTypeMap extends Map
{
	use MapHelper;

	private $type;

	public function __construct(array $array)
	{
		$item = $array[array_key_first($array)];
		$this->type = is_object($item) ? get_class($item) : gettype($item);

		$this->addEach($array);
	}

	protected function getType(): ?string
	{
		return $this->type;
	}
}
