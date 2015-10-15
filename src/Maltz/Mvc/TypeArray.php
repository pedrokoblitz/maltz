<?php

namespace Maltz\Mvc;

class TypeArray
{
    protected $items;
    
    /**
     * /
     * @param array $items [description]
     */
    public function __construct(array $items = array())
    {
        $this->items = $items;
    }

    /**
     * /
     * @param [type] $key   [description]
     * @param [type] $value [description]
     */
    public function set($key, $value)
    {
        $this->items[$key] = $value;
    }

    /**
     * /
     * @param  [type] $items [description]
     * @return [type]        [description]
     */
    public function replace($items)
    {
        $this->items = array_replace($this->items, $items);
    }

    /**
     * /
     * @param  [type]  $key [description]
     * @return boolean      [description]
     */
    public function has($key)
    {
        return isset($this->items[$key]);
    }

    /**
     * /
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public function get($key)
    {
        return isset($this->items[$key]) ? $this->items[$key] : null;
    }

    /**
     * /
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public function remove($key)
    {
        unset($this->items[$key]);
    }

    /**
     * /
     * @return [type] [description]
     */
    public function keys()
    {
        return array_keys($this->items);
    }

    /**
     * /
     * @return [type] [description]
     */
    public function values()
    {
        return array_values($this->items);
    }

    /**
     * /
     * @return [type] [description]
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * /
     * @return [type] [description]
     */
    public function clear()
    {
        $this->items = array();
    }
}
