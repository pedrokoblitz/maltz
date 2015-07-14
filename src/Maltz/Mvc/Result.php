<?php

namespace Maltz\Mvc;

class Result extends Type
{

    protected function restoreRecords($items)
    {
        foreach ($items['records'] as $key => $value) {
            $items['records'][$key] = new Record($value);
        }
        return $items;
    }

    protected function getRecordsAsArray()
    {
        $result = array();
        if (isset($this->items['records'])) {
            foreach ($this->items['records'] as $record) {
                $result[] = $record->toArray();
            }
        }
        return $result;
    }

    protected function itemsToArray($items)
    {
        $newItems = array();
        foreach ($items as $value) {
            if (is_array($value)) {
                $newItems[] = $this->itemsToArray($value);
            } elseif ($value instanceof Record) {
                $newItems[] = $value->toArray();
            } elseif (is_scalar($value)) {
                $newItems[] = $value;
            }
        }
        return $newItems;
    }

    /*
     *
     */
    public function fromJson($json)
    {
        $this->dirty = false;
        $this->items = $this->restoreRecords(json_decode($json));
    }

    /*
     *
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /*
     *
     */
    public function unserialize($items)
    {
        $this->items = $this->restoreRecords(unserialize($items));
    }

    /*
     *
     */
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

    public function toArray()
    {
        return $this->itemsToArray($this->items);
    }
}