<?php

namespace Maltz\Mvc\ModelFeature;

trait Metadata
{
    public function addMeta(Record $record)
    {
        $item_name = $record->get('item_name');
        $item_id = $record->get('item_id');
        $key = $record->get('key');
        $value = $record->get('value');
        $order = $record->get('order');
        
        if (!is_string($item_name) || !is_int($item_id) || !is_string($key) || !is_string($value) || !is_int($order)) {
            throw new \Exception("Invalid input type", 1);
        }

        $sql = "INSERT INTO metadata (item_name, item_id, key, value) VALUES (:item_name, :item_id, :key, :value)";
        $result = $this->db->run($sql, array('item_name' => $item_name, 'item_id' => $item_id, 'key' => $key, 'value' => $value));
        return $result;
    }

    public function updateMeta(Record $record)
    {
        $item_name = $record->get('item_name');
        $item_id = $record->get('item_id');
        $key = $record->get('key');
        $value = $record->get('value');
        $order = $record->get('order');
        
        if (!is_string($item_name) || !is_int($item_id) || !is_string($key) || !is_string($value) || !is_int($order)) {
            throw new \Exception("Invalid input type", 1);
        }

        $sql = "UPDATE metadata SET value=:value, order=:order WHERE item_name=:item_name AND item_id=:item_id AND key=:key";
        $result = $this->db->run($sql, array('item_name' => $item_name, 'item_id' => $item_id, 'key' => $key, 'value' => $value));
        return $result;
    }

    public function removeMeta(Record $record)
    {
        $item_name = $record->get('item_name');
        $item_id = $record->get('item_id');
        $key = $record->get('key');

        if (!is_string($item_name) || !is_int($item_id) || !is_string($key)) {
            throw new \Exception("Invalid input type", 1);
        }

        $sql = "DELETE FROM metadata WHERE item_name=:item_name AND item_id=:item_id AND key=:key";
        $result = $this->db->run($sql, array('item_name' => $item_name, 'item_id' => $item_id, 'key' => $key));
        return $result;
    }

    public function getMeta($item_name, $item_id, $key)
    {
        if (!is_string($item_name) || !is_int($item_id) || !is_string($key)) {
            throw new \Exception("Invalid input type", 1);
        }

        $sql = "SELECT id, item_name, item_id, key, value FROM metadata WHERE item_name=:item_name AND item_id=:item_id AND key=:key";
        $result = $this->db->run($sql, array('item_name' => $item_name, 'item_id' => $item_id, 'key' => $key));
        return $result;
    }

    public function getAllMeta($item_name, $item_id)
    {
        if (!is_string($item_name) || !is_int($item_id)) {
            throw new \Exception("Invalid input type", 1);
        }

        $sql = "SELECT id, item_name, item_id, key, value FROM metadata";
        $result = $this->db->run($sql, array('item_name' => $item_name, 'item_id' => $item_name));
        return $result;
    }
}
