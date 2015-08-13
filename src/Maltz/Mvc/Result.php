<?php

namespace Maltz\Mvc;

class Result extends TypeArray
{
    protected function itemsToArray($items)
    {
        $newItems = array();
        foreach ($items as $key => $value) {
            if (is_array($value)) {
                $newItems[$key] = $this->itemsToArray($value);
            } elseif ($value instanceof Record) {
                $newItems[$key] = $value->toArray();
            } else {
                $newItems[$key] = $value;
            }
        }
        return $newItems;
    }

    public function fromJson($json)
    {
        $this->dirty = false;
        $this->items = $this->restoreRecords(json_decode($json));
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function unserialize($items)
    {
        $this->items = $this->restoreRecords(unserialize($items));
    }

    public function serialize()
    {
        return serialize($this->toArray());
    }

    public function getFirstRecord()
    {
        return isset($this->items['records']) ? $this->items['records'][0] : null;
    }

    public function getRecords()
    {
        return isset($this->items['records']) ? $this->items['records'] : null;
    }

    public function getLastInsertId()
    {
        return isset($this->items['last.insert.id']) ? $this->items['last.insert.id'] : null;
    }

    public function getIdList()
    {
        return isset($this->items['id.list']) ? $this->items['id.list'] : null;
    }

    public function getCount()
    {
        return isset($this->items['count']) ? $this->items['count'] : null;
    }

    public function getMessage()
    {
        return isset($this->items['message']) ? $this->items['message'] : null;
    }

    public function isSuccessful()
    {
        return isset($this->items['success']) ? $this->items['success'] : null;
    }

    public function toArray()
    {
        return $this->itemsToArray($this->items);
    }
}
