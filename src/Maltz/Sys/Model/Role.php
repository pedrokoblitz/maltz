<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;

class Role extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'role', 'roles', 'role_id');
    }

    public function list($offset, $limit) {
        $sql = "SELECT name, activity FROM roles LIMIT ?,?";
        $resultado = $this->db->run($sql, array($offset, $limit));
        return $resultado;
    }

    public function show($id) {
        $sql = "SELECT id, name, activity FROM roles WHERE id=?";
        $resultado = $this->db->run($sql, array($id));
        return $resultado;
    }

    public function insert(Record $record) {
        $sql = "INSERT INTO roles (name, activity)
            VALUES (?,?)";
        $resultado = $this->db->run($sql, $record->values());
        return $resultado;
    }
    public function update(Record $record) {
        $sql = "UPDATE roles SET name=?, activity=? WHERE id=?";
        $bind = array(
            $record->get('name'),
            $record->get('activity'),
            $record->get('id')
        );
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
    }

    public function delete($id) {
        $sql = "DELETE FROM roles WHERE id=?";
        $resultado = $this->db->run($sql, array($id));
        return $resultado;
    }

}