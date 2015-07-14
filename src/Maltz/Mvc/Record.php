<?php

namespace Maltz\Mvc;

class Record extends TypeArray
{
    protected $dirty = false;
    protected $valid = true;

    public function __construct(array $items)
    {
        $this->items = array_filter($items);
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
        return md5(serialize($this->items));
    }

    protected function validate($rules)
    {
        foreach ($rules as $key => $rule) {
            if ($this->has($key)) {
                $valid = Validation::$rule($this->items[$key]);
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
        return '(' . implode(',', array_filter($this->items)) . ')';
    }

    public function getInsertValueString()
    {
        return '(:' . implode(',:', array_filter($this->items)) . ')';
    }

    public function getUpdateValueString()
    {
        $str = '';
        foreach (array_filter($this->items) as $key => $value) {
            $str .= $key . '=:' . $key . ',';
        }
        return rtrim($str, ',');
    }
}