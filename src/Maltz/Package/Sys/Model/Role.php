<?php

namespace Maltz\Package\Sys\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\ModelFeature\Activity;
use Maltz\Service\Pagination;

class Role extends Model
{
    use Activity;

    public function __construct(DB $db)
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

    public function display()
    {
        $sql = "SELECT id, name, activity FROM roles";
        $result = $this->db->run($sql);
        return $result;
    }

    public function find($page = 1, $per_page = 12, $key = 'name', $order = 'asc')
    {
        if (!is_int($page) || !is_int($per_page) || !is_string($key) || !is_string($order)) {
            throw new \Exception("Invalid input type", 1);
        }
        
        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT id, name, activity 
            FROM roles 
            ORDER BY $key $order 
            LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql, array());
        return $result;
    }

    public function show($id)
    {
        if (!is_int($id) ) {
            throw new \Exception("Id must be integer.", 001);
        }
        
        $sql = "SELECT id, name, activity 
            FROM roles 
            WHERE id=:id";
        $result = $this->db->run($sql, array('id' => $id));
        return $result;
    }

    public function insert(Record $record)
    {
        $sql = "INSERT INTO roles (name, activity)
            VALUES (:name, :activity)";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }
    
    public function update(Record $record)
    {
        $sql = "UPDATE roles SET name=:name, activity=:activity 
            WHERE id=:id";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }
}
