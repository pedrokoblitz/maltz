<?php

namespace Maltz\Mvc;

class Result {

    protected $dirty = false;
    protected $valid = true;
    protected $items = array();

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function set($key, $value)
    {
        $this->dirty = true;
        $this->items[$key] = $key;
    }

    public function has($key)
    {
        return isset($this->items[$key]);
    }

    public function get($key)
    {
        return $this->items[$key];
    }

    public function remove($key)
    {
        $this->dirty = true;
        unset($this->items[$key]);
    }

    public function validate($key, $type)
    {
        switch ($type) {
            case 'int':
                $valid = intval($this->items[$key]) ? true : false;
                break;
            
            case 'string':
                $valid = is_string($this->items[$key]) ? true : false;
                break;
            
            case 'array':
                $valid = is_array($this->items[$key]) ? true : false;
                break;

            case 'scalar':
                $valid = is_scalar($this->items[$key]) ? true : false;
                break;
            
            case 'object':
                $valid = is_object($this->items[$key]) ? true : false;
                break;
            
            case 'float':
                $valid = floatval($this->items[$key]) ? true : false;
                break;
            
            default:
                $valid = preg_match($type, $this->items[$key]) ? true : false;
                break;
        }
        $this->valid = $valid;
    }

    public function keys()
    {
        return array_keys($this->items);
    }

    public function values()
    {
        return array_values($this->items);
    }

    public function clear()
    {
        $this->dirty = true;
        $this->items = array();
    }

    public function fromArray(array $items)
    {
        $this->items = $items;
    }

    public function toArray()
    {
        return $this->items;
    }

    public function toObject()
    {
        return (object) $this->items;
    }

    public function fromJson($json)
    {
        $this->dirty = false;
        $this->items = json_decode($json);
    }

    public function toJson()
    {
        return json_encode($this->items);
    }

    public function unserialize($items)
    {
        $this->dirty = false;
        $this->items = unserialize($items);
    }

    public function serialize()
    {
        return serialize($this->items);
    }

    public function getMd5()
    {
        return md5(serialize($this->items));
    }

    public function isValid()
    {
        return $this->valid;
    }

    public function isDirty()
    {
        return $this->dirty;
    }

    public function isEquals(Result $other)
    {
        return $this->getMd5() === $other->getMd5();
    }

    public function merge(Result $other)
    {
        $this->dirty = true;
        $old_items = $this->toArray();
        $new_items = $other->toArray();
        $this->items = array_merge($old_items, $new_items);
    }

    public function getRecords()
    {
        return $this->items['records'];
    }

    public function getRow()
    {
        return $this->items['records'][0];
    }
}