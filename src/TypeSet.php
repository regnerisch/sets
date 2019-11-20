<?php

namespace Regnerisch\Sets;

use Regnerisch\Sets\Traits\ArrayHelper;

final class TypeSet extends Set
{
	use ArrayHelper;

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
