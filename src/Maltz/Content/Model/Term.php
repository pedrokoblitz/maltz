<?php

namespace Maltz\Media\Model;

use Maltz\Mvc\Model;

class Term extends Model
{

    public function __construct($db)
    {
        parent::__construct($db, 'term', 'terms', 'term_id');
    }

    /*
     * CRUD
     */

    public function insert(Record $record)
    {
        $sql = "";
        $resultado = $this->db->run($sql);
        $sql = "";
        $resultado = $this->db->run($sql, array());
        return $resultado;
    }

    public function update(Record $record)
    {
        $sql = "";
        $resultado = $this->db->run($sql, array());
        $sql = "";
        $resultado = $this->db->run($sql, array());
        return $resultado;
    }

    public function delete($id)
    {
        $sql = "UPDATE terms SET activity=:activity WHERE id=:id";
        $resultado = $this->db->run($sql, array());
    }

    public function list($offset=0, $limit=12, $key='type', $order='asc') {
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t3.name AS type 
        FROM terms t1 
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3 
                ON t1.type_id=t3.id 
            ORDER BY $key $order
            LIMIT :offset,:limit";
        $resultado = $this->db->run($sql, array('offset' => $offset, 'limit' => $limit));
        return $resultado;
    }

    public function listByType(type, $offset=0, $limit=12, $key='type', $order='asc') {
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t3.name AS type 
        FROM terms t1 
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3 
                ON t1.type_id=t3.id 
            WHERE type=:type
            ORDER BY $key $order
            LIMIT :offset,:limit";
        $resultado = $this->db->run($sql, array('type' => $type, 'offset' => $offset, 'limit' => $limit));
        return $resultado;
    }

    public function show($id)
    {
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t2.name AS type 
        FROM terms t1 
            JOIN types t2 
                ON t1.type_id=t2.id
            WHERE id=:id";
        $resultado = $this->db->run($sql, array($id));
        return $resultado;
    }

    /*
     * RELATIONSHIPS
     */

    public function loadTypes()
    {
        $sql = "SELECT id, name FROM types WHERE item_name=:item_name;";
        $resultado = $this->db->run($sql, array('item_name' => 'term'));
        return $resultado;
    }

    public function getByType($type)
    {
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t2.name AS type 
        FROM terms t1 
            JOIN types t2 
                ON t1.type_id=t2.id 
            WHERE type=:type";
        $resultado = $this->db->run($sql, array($type));
        return $resultado;
    }

    public function getByName($name)
    {
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t2.name AS type 
        FROM terms t1 
            JOIN types t2 
                ON t1.type_id=t2.id 
            WHERE name=:name";
        $resultado = $this->db->run($sql, array($name));
        return $resultado;
    }

    public function getByValue($value)
    {
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t2.name AS type 
        FROM terms t1 
            JOIN types t2 
                ON t1.type_id=t2.id 
            WHERE value=:value";
        $resultado = $this->db->run($sql, array($value));
        return $resultado;
    }
}
