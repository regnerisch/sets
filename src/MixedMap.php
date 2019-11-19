<?php

namespace Regnerisch\Map;

final class MixedMap extends Map
{
	public function __construct(iterable $map)
	{
		$this->addEach($map);
	}

	protected function getType(): ?string
	{
		return null;
	}
}
