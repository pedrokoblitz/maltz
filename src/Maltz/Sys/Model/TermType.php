<?php

namespace Maltz\Sys\Model;

class TermType extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'term_type', 'term_types', 'term_type_id');
    }

    public function list($offset, $limit) {
        $sql = "SELECT * FROM term_types";
        $result = $this->db->run($sql);
        return $result;
    }

    public function show($id) {
        $sql = "SELECT * FROM term_types WHERE id=$id";
        $result = $this->db->run($sql);
        return $result;
    }
}