<?php

namespace Regnerisch\Sets;

use Regnerisch\Sets\Traits\ArrayHelper;

final class DetectTypeSet extends Set
{
	use ArrayHelper;

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
