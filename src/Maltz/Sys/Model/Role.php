<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;

class Role extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'role', 'roles', 'role_id');
    }

    /*
     * CRUD
     */

    public function display() {
        $sql = "SELECT id, name, activity FROM roles";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function list($offset=0, $limit=12, $key='name', $order='asc') {
        $sql = "SELECT id, name, activity FROM roles ORDER BY $key $order LIMIT :offset,:limit";
        $resultado = $this->db->run($sql, array($offset, $limit, $key, $order));
        return $resultado;
    }

    public function show($id) {
        $sql = "SELECT id, name, activity FROM roles WHERE id=:id";
        $resultado = $this->db->run($sql, array($id));
        return $resultado;
    }

    public function insert(Record $record) {
        $sql = "INSERT INTO roles (name, activity)
            VALUES (:name, :activity)";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }
    public function update(Record $record) {
        $sql = "UPDATE roles SET name=:name, activity=:activity WHERE id=:id";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }

    public function delete($id) {
        $sql = "DELETE FROM roles WHERE id=:id";
        $resultado = $this->db->run($sql, array($id));
        return $resultado;
    }

}