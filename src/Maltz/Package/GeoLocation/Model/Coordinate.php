<?php

namespace Maltz\Package\GeoLocation\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;
use Maltz\Mvc\Record;

class Coordinate extends Model
{
    public function __construct(DB $db)
    {
        $rules = array();
        parent::__construct($db, 'coordinate', 'coordinates', $rules);
    }

    public function find($page = 1, $per_page = 12)
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
}