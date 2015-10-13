<?php

namespace Maltz\Package\Radar\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;
use Maltz\Mvc\Record;

class Estate extends Model
{
    public function __construct(DB $db)
    {
        $rules = array();
        parent::__construct($db, 'estate', 'estates', $rules);
    }

    public function find($page = 1, $per_page = 12, $key = null, $order = null)
    {
        $sql = "";
        $result = $this->db->run($sql, array('' => ''));
        return $result;
    }

    public function show($id)
    {
        $sql = "";
        $result = $this->db->run($sql, array('' => ''));
        return $result;
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
}