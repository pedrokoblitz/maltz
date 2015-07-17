<?php

namespace Maltz\Mvc;

use Maltz\Mvc\Record;

trait Metadata
{
    public function saveMeta(Record $record)
    {
        if ($record->has('id')) {
            return $this->updateMeta($record);
        } else {
            return $this->addMeta($record);
        }
    }

    public function addMeta(Record $record)
    {
        $sql = "INSERT INTO metadata (item_name, item_id, key, value) VALUES (:item_name, :item_id, :key, :value)";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    public function updateMeta(Record $record)
    {
        $sql = "";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    public function removeMeta($item_name, $item_id, $key)
    {
        if (!is_string($item_name) || !is_int($item_id) || !is_string($key)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "DELETE FROM metadata WHERE item_name=:item_name AND item_id=:item_id AND key=:key";
        $result = $this->db->run($sql, array('item_name' => $item_name, 'item_id' => $item_id, 'key' => $key));
        return $result;
    }

    public function getMeta($item_name, $item_id, $key)
    {
        if (!is_string($item_name) || !is_int($item_id) || !is_string($key)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "SELECT id, item_name, item_id, key, value FROM metadata WHERE item_name=:item_name AND item_id=:item_id AND key=:key";
        $result = $this->db->run($sql, array('item_name' => $item_name, 'item_id' => $item_id, 'key' => $key));
        return $result;
    }

    public function getAllMeta($item_name, $item_id)
    {
        if (!is_string($item_name) || !is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "SELECT id, item_name, item_id, key, value FROM metadata";
        $result = $this->db->run($sql, array('item_name' => $item_name, 'item_id' => $item_name));
        return $result;
    }
}
