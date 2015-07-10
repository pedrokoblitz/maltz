<?php

namespace Maltz\Mvc;

class Result extends Type
{
    protected $dirty = false;

    protected $valid = true;

    protected $items = array();

    /*
     *
     */
    public function validate($key, $rule)
    {
        switch ($rule) {
            case 'int':
                $valid = Validacao::numero($this->items[$key]) ? true : false;
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
                $valid = Validacao::numeroReal($this->items[$key]) ? true : false;
                break;
            
            default:
                $valid = preg_match($type, $this->items[$key]) ? true : false;
                break;
        }
        $this->valid = $valid;
    }

    /*
     *
     */
    public function isValid()
    {
        return $this->valid;
    }

    /*
     *
     */
    public function isDirty()
    {
        return $this->dirty;
    }

    /*
     *
     */
    public function isEquals(Result $other)
    {
        return $this->getMd5() === $other->getMd5();
    }
}