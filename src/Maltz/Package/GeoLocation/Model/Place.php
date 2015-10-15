<?php

namespace Maltz\Package\GeoLocation\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;
use Maltz\Mvc\Record;

class Place extends Model
{
    /**
     * /
     * @param DB $db [description]
     */
    public function __construct(DB $db)
    {
        $rules = array();
        parent::__construct($db, 'place', 'places', $rules);
    }

    /**
     * /
     * @param  integer $page     [description]
     * @param  integer $per_page [description]
     * @param  [type]  $key      [description]
     * @param  [type]  $order    [description]
     * @return [type]            [description]
     */
    public function find($page = 1, $per_page = 12, $key = null, $order = null)
    {
        $sql = "";
        $result = $this->db->run($sql, array('' => ''));
        return $result;
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
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
}