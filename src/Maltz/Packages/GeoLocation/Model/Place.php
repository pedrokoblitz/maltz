<?php

namespace Maltz\Geo\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;

class Place
{
    public function __construct(DB $db)
    {
        parent::__construct($db);
    }

    public function find($page = 1, $per_page = 12, $key = null, $order = null)
    {
        $sql = "";
        $result = $this->db->run($sql, array('' => ));
        return $result;
    }

    public function show($id)
    {
        $sql = "";
        $result = $this->db->run($sql, array('' => ));
        return $result;
    }

    public function insert(Record $record)
    {
        $sql = "";
        $result = $this->db->run($sql, array('' => ));
        return $result;
    }

    public function update(Record $record)
    {
        $sql = "";
        $result = $this->db->run($sql, array('' => ));
        return $result;
    }
}