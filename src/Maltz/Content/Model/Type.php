<?php

namespace Maltz\Media\Model;

use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Service\Pagination;

class Type extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'type', 'types', 'type_id');
    }

    /*
     * CRUD
     */

    public function display($key='name', $order='asc') {
        $sql = "SELECT id, item_name, name FROM types ORDER By $key $order";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function list($page=1, $per_page=12, $key='name', $order='asc') {
        $pagination = Pagination::paginate($page, $per_page);

        $sql = "SELECT id, item_name, name FROM types ORDER By $key $order LIMIT :offset,:limit";
        $resultado = $this->db->run($sql, array('offset' => $pagination->offset, 'limit' => $pagination->limit));
        return $resultado;
    }

    public function show($id) {
        $sql = "SELECT id, item_name, name FROM types WHERE id=:id";
        $resultado = $this->db->run($sql, array('id' => $id));
        return $resultado;
    }

    public function insert(Record $record) 
    {
        $values = $record->getInsertValueString();
        $sql = "INSERT INTO types (id, item_name, name) VALUES $values";        
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }

    public function update(Record $record) 
    {
        $values = $record->getUpdateValueString();
        $sql = "UPDATE types SET $values WHERE id=:id";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }

    public function delete($id) 
    {
        $sql = "DELETE FROM types WHERE id=:id";
        $resultado = $this->db->run($sql, array('id' => $id));
        return $resultado;
    }
}
