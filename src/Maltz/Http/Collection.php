<?php

namespace Maltz\Http;

/**
 * The short description
 *
 * As many lines of extendend description as you want {@link element}
 * links to an element
 * {@link http://www.example.com Example hyperlink inline link} links to
 * a website. The inline
 *
 * @package Maltz
 * @subpackage Http
 * @author  Pedro Koblitz
 */
class Collection
{

    /**
     * @var array store collection items
     */
    protected $items = array();

    /**
     * Sort model array
     *
     * @access public
     * @param  \Closure [$sorter] function to sort the items
     * @return void
     */
    public function sort(\Closure $sorter)
    {
        $this->items = usort($this->items, $sorter);
    }

    /**
     * add groups of models
     *
     * @access public
     * @param  array [$items] items to map into the collection
     * @return void
     */
    public function map(array $items)
    {
        array_map(array($this, 'set'), array_keys($items), $items);
    }

    /**
     * Adds model from array and sets key based on model id
     *
     * @access public
     * @param  scalar [$id] key to store the item
     * @param  mixed [$item] item to insert in collection
     * @return void
     */
    public function set($id, $item)
    {
        if (!is_scalar($id)) {
            throw new \InvalidArgumentException('$id must be scalar');
        }

        if (!$this->isValidItem($item)) {
            throw new \InvalidArgumentException("Invalid item", 001);
        }

        $this->items[$id] = $item;
    }

    /**
     * Checks in key is already set
     *
     * @access public
     * @param scalar $key Key to check in collection array
     */
    public function has($key)
    {
        if (!is_scalar($key)) {
            throw new \InvalidArgumentException('$id must be scalar');
        }

        return isset($this->items[$key]);
    }

    /**
     * Check if item is valid. Should be overriden in child classes.
     * 
     * @access public
     * @param mixed $item Item to be checked.
     */
    protected function isValidItem($item)
    {
        return true;
    }

    /**
     * Gets model from array based on id/key
     *
     * @access public
     * @param  scalar [$id] Key for returning item
     * @throws InvalidArgumentExecption input check
     * @return mixed description
     */
    public function get($id)
    {
        if (!is_scalar($id)) {
            throw new \InvalidArgumentException('$id must be scalar', 002);
        }

        if (isset($this->items[$id])) {
            return $this->items[$id];
        }

        return false;
    }

    /**
     * Remove model from array based on id/key
     *
     * @access public
     * @param  scalar [$id] Key to remove from collection
     * @throws InvalidArgumentException type check
     * @return void
     */
    public function remove($id)
    {
        if (!is_scalar($id)) {
            throw new \InvalidArgumentException('$id must be scalar', 003);
        }

        if (isset($this->items[$id])) {
            unset($this->items[$id]);
        }
    }

    /**
     * Clears all items
     * 
     * @access public
     * @return void
     */
    public function clear()
    {
        $this->items = array();
    }
}
