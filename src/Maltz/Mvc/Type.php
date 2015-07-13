<?php

namespace Maltz\Mvc;

class Type
{
    protected $items;
    
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
        $this->items[$key] = $value;
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
    public function count()
    {
        return count($this->items);
    }

    /*
	 *
	 */
    public function clear()
    {
        $this->items = array();
    }
}