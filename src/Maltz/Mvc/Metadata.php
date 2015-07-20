<?php

namespace Maltz\Mvc;

use Maltz\Mvc\Record;

trait Metadata
{
    public function addMeta($item_name, $item_id, $key, $value)
    {
        if (!is_string($item_name) || !is_int($item_id) || !is_string($key) || !is_string($value)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "INSERT INTO metadata (item_name, item_id, key, value) VALUES (:item_name, :item_id, :key, :value)";
        $result = $this->db->run($sql, array('item_name' => $item_name, 'item_id' => $item_id, 'key' => $key, 'value' => $value));
        return $result;
    }

    public function updateMeta($item_name, $item_id, $key, $value)
    {
        if (!is_string($item_name) || !is_int($item_id) || !is_string($key) || !is_string($value)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "UPDATE metadata SET value=:value WHERE item_name=:item_name AND item_id=:item_id AND key=:key";
        $result = $this->db->run($sql, array('item_name' => $item_name, 'item_id' => $item_id, 'key' => $key, 'value' => $value));
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
