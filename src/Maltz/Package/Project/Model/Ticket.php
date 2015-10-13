<?php

namespace Maltz\Package\Project\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\ModelFeature\Activity;
use Maltz\Service\Pagination;

class Ticket extends Model
{
    public function __construct(DB $db)
    {
        $rules = array(
            'id' => 'int',
            'dev_id' => 'int',
            'user_id' => 'int',
            'hash' => 'string',
            'description' => 'textarea',
            'priority' => 'int',
            'activity' => 'int'
            );
        parent::__construct($db, 'ticket', 'tickets', $rules);
    }

    public function show($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be string", 001);
        }

        $sql = "SELECT (id, dev_id, user_id, hash, priority, description, activity, created, modified) 
            FROM tickets
                WHERE id=:id";
        $result = $this->db->run($sql, array('id' => $id));
        return $result;
    }

    public function insert(Record $record)
    {
        $sql = "INSERT INTO tickets (dev_id, user_id, hash, priority, description, activity, created, modified) 
            VALUES (:dev_id, :user_id, UUID(), :priority, :description, :activity, NOW(), NOW())";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    public function find($key = 'modified')
    {
        if (!is_string($key) ) {
            throw new \Exception("Key must be string.", 002);
        }

        $sql = "SELECT (dev_id, user_id, hash, priority, description, activity, created, modified) FROM tickets
            WHERE activity > 1
            ORDER BY $key DESC";
        $result = $this->db->run($sql);
        return $result;
    }

    public function findAll($pg = 1, $per_page = 20)
    {
        if (!is_int($pg) || !is_int($per_page)) {
            throw new \Exception("Page and per_page must be integers.", 003);
        }

        $pagination = Pagination::paginate($pg, $per_page);
        $sql = "SELECT (dev_id, user_id, hash, priority, description, activity, created, modified) FROM tickets
            ORDER BY modified DESC, activity DESC, priority DESC
            LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql);
        return $result;
    }

    public function changePriority($id, $priority)
    {
        if (!is_int($id) || !is_string($priority)) {
            throw new \Exception("Id must be integer and priority must be string.", 004);
        }

        $sql = "UPDATE SET priority=:priority, modified=NOW() WHERE id=:id";
        $result = $this->db->run($sql, array('id' => $id, 'priority' => $priority));
        return $result;
    }

    public function close($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 005);
        }

        $sql = "UPDATE SET activity=:activity, modified=NOW() WHERE id=:id";
        $result = $this->db->run($sql, array('activity' => 1, 'id' => $id));
        return $result;
    }

    public function getDev($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 006);
        }

        $sql = "SELECT t2.id, t2.username, t2.name, t2.email FROM tickets t1
            JOIN users t2
                ON t1.dev_id=t2.id
            WHERE t1.id=:id";
        $record = $this->db->run($sql, array('id' => $id))->getFirstRecord();
        if (!$record instanceof Record) {
            throw new \Exception("Invalid record", 1);
        }
        return $record->get('email');
    }
}
