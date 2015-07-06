<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;

class Term extends Model
{

    public function __construct($db)
    {
        parent::__construct($db, 'term', 'terms', 'term_id');
    }

    public function index()
    {
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t2.name AS type FROM terms t1 JOIN term_types t2 ON t1.term_type_id=t2.id LIMIT :offset,:quantity;";
        $result = $this->db->run($sql);
    }

    public function loadTypes()
    {
        $sql = "SELECT id, name FROM term_types;";
    }

    public function show($id)
    {
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t2.name AS type FROM terms t1 JOIN term_types t2 ON t1.term_type_id=t2.id WHERE id=:id;";
    }

    public function getByType($type)
    {
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t2.name AS type FROM terms t1 JOIN term_types t2 ON t1.term_type_id=t2.id WHERE type=:type;";
        $result = $this->db->run($sql);
    }

    public function getByName($name)
    {
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t2.name AS type FROM terms t1 JOIN term_types t2 ON t1.term_type_id=t2.id WHERE name=:name;";
        $result = $this->db->run($sql);
    }

    public function getByValue($value)
    {
        $sql = "SELECT t1.id AS id, t1.parent_id AS parent_id, t1.name AS name, t1.value AS value, t2.name AS type FROM terms t1 JOIN term_types t2 ON t1.term_type_id=t2.id WHERE value=:value;";
        $result = $this->db->run($sql);
    }
}
