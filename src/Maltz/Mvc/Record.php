<?php

namespace Maltz\Mvc;

class Record extends TypeArray
{
    protected $dirty = false;
    protected $valid = true;

    public function __construct(array $items)
    {
        $this->items = $items;
        $this->validation = new Validation();
    }

    public function fromArray(array $items)
    {
        $this->items = $items;
    }

    public function toArray()
    {
        return $this->items;
    }

    public function getMd5()
    {
        return md5(serialize($this->toArray()));
    }

    protected function filterByKeys($allowed)
    {
        $this->items = array_intersect_key($this->items, array_flip($allowed));
    }

    public function validate($rules)
    {
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

    public function clear()
    {
        $this->dirty = true;
        parent::clear();
    }

    public function remove($key)
    {
        $this->dirty = true;
        parent::remove($key);
    }

    public function set($key, $value)
    {
        $this->dirty = true;
        parent::set($key, $value);
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

    public function getFieldsList()
    {
        return '(' . implode(',', $this->keys()) . ')';
    }

    public function getInsertValueString()
    {
        return '(:' . implode(',:', $this->keys()) . ')';
    }

    public function getUpdateValueString()
    {
        $str = '';
        foreach ($this->keys() as $key) {
            $str .= $key . '=:' . $key . ',';
        }
        return rtrim($str, ',');
    }
}
