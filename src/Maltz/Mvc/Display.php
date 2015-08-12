<?php

namespace Maltz\Mvc;

trait Display
{
    public function display()
    {
        $sql = "SELECT t1.id, t1.parent_id, t2.slug, t2.title, t2.subtitle, t2.excerpt, t2.description, t2.body, t3.name AS type
            FROM $this->table t1
                JOIN translations t2
                    ON t1.id=t2.item_id
                    AND t2.item_name=:item_name
                JOIN types t3
                    ON t1.type_id=t3.id";
        $result = $this->db->run($sql, array('item_name' => $this->slug));
        return $result;
    }

    public function displayByType($type)
    {
        if (!is_string($type)) {
            throw new \Exception("Type name must be string", 001);
        }

        $sql = "SELECT t1.id, t1.parent_id, t2.slug, t2.title, t2.subtitle, t2.excerpt, t2.description, t2.body, t3.name AS type
            FROM $this->table t1
                JOIN translations t2
                    ON t1.id=t2.item_id
                    AND t2.item_name=:item_name
                JOIN types t3
                    ON t1.type_id=t3.id
                WHERE t3.name=:type";
        $result = $this->db->run($sql, array('item_name' => $this->slug, 'type' => $type));
        return $result;
    }
}
