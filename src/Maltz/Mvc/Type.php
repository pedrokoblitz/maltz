<?php

namespace Maltz\Mvc;

class Type
{

    /*
	 *
	 */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /*
	 *
	 */
    public function set($key, $value)
    {
        $this->dirty = true;
        $this->items[$key] = $key;
    }

    /*
	 *
	 */
    public function has($key)
    {
        return isset($this->items[$key]);
    }

    /*
	 *
	 */
    public function get($key)
    {
        return $this->items[$key];
    }

    /*
	 *
	 */
    public function remove($key)
    {
        $this->dirty = true;
        unset($this->items[$key]);
    }

    /*
	 *
	 */
    public function keys()
    {
        return array_keys($this->items);
    }

    /*
	 *
	 */
    public function values()
    {
        return array_values($this->items);
    }

    /*
	 *
	 */
    public function clear()
    {
        $this->dirty = true;
        $this->items = array();
    }

    /*
	 *
	 */
    public function fromArray(array $items)
    {
        $this->items = $items;
    }

    /*
	 *
	 */
    public function toArray()
    {
        return $this->items;
    }

    /*
	 *
	 */
    public function toObject()
    {
        return (object) $this->items;
    }

    /*
	 *
	 */
    public function fromJson($json)
    {
        $this->dirty = false;
        $this->items = json_decode($json);
    }

    /*
	 *
	 */
    public function toJson()
    {
        return json_encode($this->items);
    }

    /*
	 *
	 */
    public function unserialize($items)
    {
        $this->dirty = false;
        $this->items = unserialize($items);
    }

    /*
	 *
	 */
    public function serialize()
    {
        return serialize($this->items);
    }

    /*
	 *
	 */
    public function getMd5()
    {
        return md5(serialize($this->items));
    }
}