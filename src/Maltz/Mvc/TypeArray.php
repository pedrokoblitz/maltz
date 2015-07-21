<?php

namespace Maltz\Mvc;

class TypeArray
{
    protected $items;
    
    public function __construct(array $items = array())
    {
        $this->items = $items;
    }

    public function set($key, $value)
    {
        $this->items[$key] = $value;
    }

    public function replace($items)
    {
        $this->items = array_replace($this->items, $items);
    }

    public function has($key)
    {
        return isset($this->items[$key]);
    }

    public function get($key)
    {
        return isset($this->items[$key]) ? $this->items[$key] : null;
    }

    public function remove($key)
    {
        unset($this->items[$key]);
    }

    public function keys()
    {
        return array_keys($this->items);
    }

    public function values()
    {
        return array_values($this->items);
    }

    public function count()
    {
        return count($this->items);
    }

    public function clear()
    {
        $this->items = array();
    }
}
