<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;

class Role extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'role', 'roles', 'role_id');
    }

    public function list() {
        $sql = "";
        $result = $this->db->run($sql);
    }

    public function show() {
        $sql = "";
        $result = $this->db->run($sql);
    }
}