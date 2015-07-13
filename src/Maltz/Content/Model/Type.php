<?php

namespace Maltz\Media\Model;

class Type extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'type', 'types', 'type_id');
    }

    /*
     * CRUD
     */

    public function list($offset=0, $limit=12, $key='name', $order='asc') {
        $sql = "SELECT id, item_name, name FROM types ORDER BU $key $order LIMIT :offset,:limit";
        $resultado = $this->db->run($sql, array('offset' => $offset, 'limit' => $limit));
        return $resultado;
    }

    public function show($id) {
        $sql = "SELECT id, item_name, name FROM types WHERE id=:id";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function insert(Record $record) 
    {
        $values = $record->getInsertValueString();
        $bind = $record->toArray();
        $sql = "INSERT INTO types (id, item_name, name) VALUES $values";        
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
    }

    public function update(Record $record) 
    {
        $values = $record->getUpdateValueString();
        $sql = "UPDATE types SET $values WHERE id=:id";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }

    public function delete($id) 
    {
        $sql = "DELETE FROM types WHERE id=:id";
        $resultado = $this->db->run($sql, array($id));
        return $resultado;
    }
}
