<?php

trait Translateable
{
    public function getTranslations($item_id)
    {
        $sql = "SELECT * FROM translations WHERE item_name=:item_name AND item_id=item_id";
        $resultado = $this->db->run($sql, array('item_name' => $this->slug, 'item_id' => $item_id));
        return $resultado;
    }

    public function addTranslation(Record $record)
    {
        $fields = $record->getFieldsList();
        $values = $record->getInsertValueString();
        $sql = "INSERT INTO translations $fields, created VALUES $values, NOW()";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }

    public function removeTranslation($item_id)
    {
        $sql = "DELETE FROM translations WHERE item_name=:item_name, item_id=:item_id";
        $resultado = $this->db->run($sql, array('item_name' => $this->slug,'item_id' => $item_id));
        return $resultado;
    }
}