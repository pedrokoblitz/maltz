<?php

namespace Maltz\Mvc;

class Result extends Type
{

    /*
     *
     */
    public function fromJson($json)
    {
        $this->dirty = false;
        $this->items = json_decode($json);
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
        $this->items = unserialize($items);
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
        return $this->items['records'][0];
    }

    public function getRecords()
    {
        return $this->items['records'];
    }

    public function getRecordsAsArray()
    {
        $result = array();
        foreach ($this->items['records'] as $record) {
            $result[] = $record->toArray();
        }
        return $result;
    }

    public function toArray()
    {
        $newItems = array();
        foreach ($this->items as $value) {
            if (is_array($value)) {
                $newItems[] = $this->recordsToArray($value);
            } elseif (instanceof Record) {
                $newItems[] = $value->toArray();
            } elseif (is_scalar($value)) {
                $newItems[] = $value;
            }
        }
        return $newItems;
    }
}