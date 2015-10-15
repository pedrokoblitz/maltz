<?php

namespace Maltz\Mvc;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

class Result extends TypeArray
{
    /**
     * /
     * @param  [type] $items [description]
     * @return [type]        [description]
     */
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

    /**
     * /
     * @param  [type] $json [description]
     * @return [type]       [description]
     */
    public function fromJson($json)
    {
        $this->dirty = false;
        $this->items = $this->restoreRecords(json_decode($json));
    }

    /**
     * /
     * @return [type] [description]
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * /
     * @param  [type] $items [description]
     * @return [type]        [description]
     */
    public function unserialize($items)
    {
        $this->items = $this->restoreRecords(unserialize($items));
    }

    /**
     * /
     * @return [type] [description]
     */
    public function serialize()
    {
        return serialize($this->toArray());
    }

    /**
     * /
     * @return [type] [description]
     */
    public function getFirstRecord()
    {
        return isset($this->items['records']) ? $this->items['records'][0] : null;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function getRecords()
    {
        return isset($this->items['records']) ? $this->items['records'] : null;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function getLastInsertId()
    {
        return isset($this->items['last.insert.id']) ? $this->items['last.insert.id'] : null;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function getIdList()
    {
        return isset($this->items['id.list']) ? $this->items['id.list'] : null;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function getCount()
    {
        return isset($this->items['count']) ? $this->items['count'] : null;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function getMessage()
    {
        return isset($this->items['message']) ? $this->items['message'] : null;
    }

    /**
     * /
     * @return boolean [description]
     */
    public function isSuccessful()
    {
        return isset($this->items['success']) ? $this->items['success'] : null;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function toArray()
    {
        return $this->itemsToArray($this->items);
    }
}
