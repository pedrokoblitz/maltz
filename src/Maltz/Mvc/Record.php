<?php

namespace Maltz\Mvc;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

class Record extends TypeArray
{
    /**
     * [$dirty description]
     * @var boolean
     */
    protected $dirty = false;

    /**
     * [$valid description]
     * @var boolean
     */
    protected $valid = true;

    /**
     * [$validation description]
     * @var null
     */
    protected $validation = null;

    /**
     * /
     * @param array  $items      [description]
     * @param [type] $validation [description]
     */
    public function __construct(array $items, $validation = null)
    {
        $this->items = $items;

        if ($validation && $validation instanceof Validation) {
            $this->validation = $validation;
        }
    }

    /**
     * /
     * @param  array|null $keys [description]
     * @return [type]           [description]
     */
    public function newInstance(array $keys = null)
    {
        if ($keys) {
            $items = array_intersect_key($this->items, array_flip($keys));
        } else {
            $items = $this->items;
        }
        return new Record($items);
    }

    /**
     * /
     * @param  array  $items [description]
     * @return [type]        [description]
     */
    public function fromArray(array $items)
    {
        $this->items = $items;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function toArray()
    {
        return $this->items;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function getMd5()
    {
        return md5(serialize($this->toArray()));
    }

    /**
     * /
     * @param  [type] $allowed [description]
     * @return [type]          [description]
     */
    protected function filterByKeys($allowed)
    {
        $this->items = array_intersect_key($this->items, array_flip($allowed));
    }

    /**
     * /
     * @param  [type] $rules [description]
     * @return [type]        [description]
     */
    public function validate($rules)
    {
        if (!$this->validation) {
            throw new \Exception("Validation object is not set.", 001);
        }

        $this->filterByKeys(array_keys($rules));
        foreach ($rules as $key => $rule) {
            if ($this->has($key) && !empty($this->get($key))) {
                $valid = $this->validation->$rule($this->items[$key]);
                if (!$valid) {
                    $this->valid = false;
                    return;
                }
            }
        }
        $this->valid = true;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function clear()
    {
        $this->dirty = true;
        parent::clear();
    }

    /**
     * /
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public function remove($key)
    {
        $this->dirty = true;
        parent::remove($key);
    }

    /**
     * /
     * @param [type] $key   [description]
     * @param [type] $value [description]
     */
    public function set($key, $value)
    {
        $this->dirty = true;
        parent::set($key, $value);
    }

    /**
     * /
     * @return boolean [description]
     */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     * /
     * @return boolean [description]
     */
    public function isDirty()
    {
        return $this->dirty;
    }

    /**
     * /
     * @param  Result  $other [description]
     * @return boolean        [description]
     */
    public function isEquals(Result $other)
    {
        return $this->getMd5() === $other->getMd5();
    }

    /**
     * /
     * @return [type] [description]
     */
    public function getFieldsList()
    {
        return '(' . implode(',', $this->keys()) . ')';
    }

    /**
     * /
     * @return [type] [description]
     */
    public function getInsertValueString()
    {
        return '(:' . implode(',:', $this->keys()) . ')';
    }

    /**
     * /
     * @return [type] [description]
     */
    public function getUpdateValueString()
    {
        $str = '';
        foreach ($this->keys() as $key) {
            $str .= $key . '=:' . $key . ',';
        }
        return rtrim($str, ',');
    }
}
