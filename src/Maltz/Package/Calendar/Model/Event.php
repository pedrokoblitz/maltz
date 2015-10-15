<?php

namespace Maltz\Package\Calendar\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;

class Event extends Model
{
    /**
     * /
     * @param DB $db [description]
     */
    public function __construct(DB $db)
    {
        $rules = array(
            '' => '',
        );
        parent::__construct($db, 'event', 'events', $rules);
    }

    /**
     * /
     * @param  Record $record [description]
     * @return [type]         [description]
     */
    public function insert(Record $record)
    {
        $sql = "";
        $result = $this->db->run($sql, array('' => ''));
        return $result;
    }

    /**
     * /
     * @param  Record $record [description]
     * @return [type]         [description]
     */
    public function update(Record $record)
    {
        $sql = "";
        $result = $this->db->run($sql, array('' => ''));
        return $result;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function display()
    {
        $sql = "";
        $result = $this->db->run($sql, array('' => ''));
        return $result;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function find()
    {
        $sql = "";
        $result = $this->db->run($sql, array('' => ''));
        return $result;
    }

    /**
     * /
     * @param  Record $record [description]
     * @return [type]         [description]
     */
    public function findByType(Record $record)
    {
        $sql = "";
        $result = $this->db->run($sql, array('' => ''));
        return $result;
    }
}
