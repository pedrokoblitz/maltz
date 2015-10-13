<?php

namespace Maltz\Package\Calendar\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;

class Event extends Model
{
    public function __construct(DB $db)
    {
        $rules = array(
            '' => '',
        );
        parent::__construct($db, 'event', 'events', $rules);
    }

    public function insert(Record $record)
    {
        $sql = "";
        $result = $this->db->run($sql, array('' => ''));
        return $result;
    }

    public function update(Record $record)
    {
        $sql = "";
        $result = $this->db->run($sql, array('' => ''));
        return $result;
    }

    public function display()
    {
        $sql = "";
        $result = $this->db->run($sql, array('' => ''));
        return $result;
    }

    public function find()
    {
        $sql = "";
        $result = $this->db->run($sql, array('' => ''));
        return $result;
    }

    public function findByType(Record $record)
    {
        $sql = "";
        $result = $this->db->run($sql, array('' => ''));
        return $result;
    }
}
