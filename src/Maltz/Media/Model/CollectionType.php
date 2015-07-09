<?php

namespace Maltz\Media\Model;

use Maltz\Mvc\Model;

class CollectionType extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'collection_type', 'collection_types', 'collection_type_id');
    }

    public function list() {
        $sql = "";
        $result = $this->db->run($sql);
    }

    public function show() {
        $sql = "";
        $result = $this->db->run($sql);
    }
}