<?php

namespace Maltz\Http;

/**
 *
 * The short description
 *
 * As many lines of extendend description as you want {@link element}
 * links to an element
 * {@link http://www.example.com Example hyperlink inline link} links to
 * a website. The inline
 *
 * @package      package name
 * @author       Pedro Koblitz
 *
 */
class Collection
{

    /**
     * @var
     */
    protected $items = array();

    /**
     *
     * Sort model array
     *
     * @access       public
     * @param        type [$varname] description
     * @return       type description
     *
     */
    public function sort(\Closure $sorter)
    {
        $this->items = usort($this->items, $sorter);
    }

    /**
     *
     * add groups of models
     *
     * @access       public
     * @param        type [$varname] description
     * @return       type description
     *
     */
    public function map(array $items)
    {
        array_map(array($this, 'set'), array_keys($items), $items);
    }

    /**
     *
     * Adds model from array and sets key based on model id
     *
     * @access       public
     * @param        type [$varname] description
     * @return       type description
     *
     */
    public function set($id, $item)
    {
        if (!is_scalar($id)) {
            throw new \InvalidArgumentException('$id must be scalar');
        }

        if (!$this->isValidItem($item)) {
            throw new \InvalidArgumentException("Error Processing Request");
        }

        $this->items[$id] = $item;
    }

    public function has($key)
    {
        return isset($this->items[$key]);
    }

    protected function isValidItem($item)
    {
        return true;
    }

    /**
     *
     * Gets model from array based on id/key
     *
     * @access       public
     * @param        type [$varname] description
     * @return       type description
     *
     */
    public function get($id)
    {
        if (!is_scalar($id)) {
            throw new \InvalidArgumentException('$id must be scalar');
        }

        if (isset($this->items[$id])) {
            return $this->items[$id];
        }

        return false;
    }

    /**
     *
     * Remove model from array based on id/key
     *
     * @access       public
     * @param        type [$varname] description
     * @return       type description
     *
     */
    public function remove($id)
    {
        if (!is_scalar($id)) {
            throw new \InvalidArgumentException('$id must be scalar');
        }

        if (isset($this->items[$id])) {
            unset($this->items[$id]);
        }
    }

    public function clear()
    {
        $this->items = array();
    }
}
