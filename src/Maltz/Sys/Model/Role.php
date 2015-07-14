<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\Activity;
use Maltz\Service\Pagination;

class Role extends Model
{
    use Activity;

    public function __construct($db)
    {
        $rules = array(
            'id' => 'int',
            'name' => 'string',
            'activity' => 'int',
            );
        parent::__construct($db, 'role', 'roles', $rules);
    }

    /*
     * CRUD
     */

    public function display() {
        $sql = "SELECT id, name, activity FROM roles";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function find($page=1, $per_page=12, $key='name', $order='asc') {
        $pagination = Pagination::paginate($page, $per_page);

        $sql = "SELECT id, name, activity FROM roles ORDER BY $key $order LIMIT $pagination->offset,$pagination->limit";
        $resultado = $this->db->run($sql, array());
        return $resultado;
    }

    public function show($id) {
        $sql = "SELECT id, name, activity FROM roles WHERE id=:id";
        $resultado = $this->db->run($sql, array('id' => $id));
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
}