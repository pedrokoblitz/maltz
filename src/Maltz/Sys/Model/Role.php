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
        $sql = "SELECT * FROM roles";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function show($id) {
        $sql = "SELECT * FROM roles WHERE id=$id";
        $resultado = $this->db->run($sql);
        return $resultado;
    }
}