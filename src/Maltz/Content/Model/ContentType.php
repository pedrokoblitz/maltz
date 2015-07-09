<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\Model;

class ContentType
{
    public function __construct($db)
    {
        parent::__construct($db, 'content_type', 'content_types', 'content_type_id');
    }

    public function list($offset, $limit) {
        $sql = "SELECT * FROM content_types";
        $result = $this->db->run($sql);
        return $result;
    }

    public function show($id) {
        $sql = "SELECT * FROM content_types WHERE id=$id";
        $result = $this->db->run($sql);
        return $result;
    }
}