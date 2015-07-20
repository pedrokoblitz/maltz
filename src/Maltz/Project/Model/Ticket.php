<?php

namespace Maltz\Tickets\Model;

use Maltz\Mvc\Record;
use Maltz\Service\Pagination;

class Ticket
{
    public function __construct($db)
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
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "SELECT (id, dev_id, user_id, hash, priority, description, activity, created, modified) 
            FROM tickets
                WHERE id=:id";
        $resultado = $this->db->run($sql, array('id' => $id));
        return $resultado;
    }

    public function insert(Record $record)
    {
        $sql = "INSERT INTO tickets (dev_id, user_id, hash, priority, description, activity, created, modified) 
            VALUES (:dev_id, :user_id, MD5(NOW()), :priority, :description, :activity, NOW(), NOW())";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }

    public function find($key = 'modified')
    {
        if (!is_int($id)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "SELECT (dev_id, user_id, hash, priority, description, activity, created, modified) FROM tickets
            WHERE activity > 1
            ORDER BY $key DESC";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function findAll($pg = 1, $per_page = 20)
    {
        if (!is_int($pg) || !is_int($per_page)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $pagination = Pagination::paginate($pg, $per_page);
        $sql = "SELECT (dev_id, user_id, hash, priority, description, activity, created, modified) FROM tickets
            ORDER BY modified DESC, activity DESC, priority DESC
            LIMIT $pagination->offset,$pagination->limit";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function changePriority($id, $priority)
    {
        if (!is_int($id) || !is_string($priority)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "UPDATE SET priority=:priority, modified=NOW() WHERE id=:id";
        $resultado = $this->db->run($sql, array('id' => $id, 'priority' => $priority));
        return $resultado;
    }

    public function close($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "UPDATE SET activity=:activity, modified=NOW() WHERE id=:id";
        $resultado = $this->db->run($sql, array('activity' => 1, 'id' => $id));
        return $resultado;
    }

    public function getDev($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "SELECT t2.id, t2.username, t2.name, t2.email FROM tickets t1
            JOIN users t2
                ON t1.dev_id=t2.id
            WHERE t1.id=:id";
        $resultado = $this->db->run($sql, array('id' => $id));
        return $resultado->getFirstRecord()->get('email');
    }
}
