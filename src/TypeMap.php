<?php

namespace Regnerisch\Map;

final class TypeMap extends Map
{
	private $type;

	public function __construct(iterable $map, string $type)
	{
		$this->type = $type;
		$this->addEach($map);
	}

	protected function getType(): string
	{
		return $this->type;
	}
}
