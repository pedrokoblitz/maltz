<?php

namespace Maltz\Media\Model;

use Maltz\Mvc\Model;

class CollectionType extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'collection_type', 'collection_types', 'collection_type_id');
    }

    public function list($offset, $limit) {
        $sql = "SELECT * FROM collection_types";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function show($id) {
        $sql = "SELECT * FROM collection_types WHERE id=$id";
        $resultado = $this->db->run($sql);
        return $resultado;
    }
}