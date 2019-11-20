<?php

namespace Regnerisch\Map;

abstract class ArrayAbstract implements \Iterator, \Countable
{
    protected $key = 0;

    protected $map = [];

    public function current()
    {
        return $this->map[$this->key];
    }

    public function next()
    {
        ++$this->key;
    }

    public function key()
    {
        return $this->key;
    }

    public function valid()
    {
        return isset($this->map[$this->key]);
    }

    public function rewind()
    {
        $this->key = 0;
    }

    public function count()
    {
        return count($this->map);
    }
}
