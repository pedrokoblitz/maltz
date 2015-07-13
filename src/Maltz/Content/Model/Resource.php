<?php

namespace Maltz\Media\Model;

use Maltz\Mvc\Model;
use Maltz\Mvc\Activity;
use Maltz\Mvc\Translatable;

/**
 * db de files pertencentes a albums
 *
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author      Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Maltz
 *
 * @version    0.1 alpha
 */

/*
 *
 *
 *
 * @param objeto DB
 *
 * return void
 */

class Resource extends Model
{
    use Activity;
    use Translatable;

    /*
	 * construtor
	 *
	 * @param db objeto DB
	 *
	 *
	 */
    public function __construct($db)
    {
        parent::__construct($db, 'resource', 'resources', 'resource_id');
    }

    /*
     * CRUD
     */

    public function insert(Record $record) {
        $sql = "";
        $resultado = $this->db->run($sql, array());
        $sql = "";
        $resultado = $this->db->run($sql, array());
        return $resultado;
    }

    public function update(Record $record) {
        $sql = "";
        $resultado = $this->db->run($sql, array());
        $sql = "";
        $resultado = $this->db->run($sql, array());
        return $resultado;
    }

    public function delete($id) {
        $sql = "UPDATE resources SET activity=:activity WHERE id=:id";
        $resultado = $this->db->run($sql, array('activity' => 0, 'id' => $id));
        return $resultado;
    }

    public function list($offset=0, $limit=12, $key='title', $order='asc') {
        $sql = "SELECT t1.id, t1.url, t1.filepath, t1.filename, t1.extension, t1.activity, t1.created, t1.modified, t2.title, t2.description, t3.name
        FROM resources t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
        ORDER BY $key $order
        LIMIT :offset,:limit";
        $resultado = $this->db->run($sql, array('offset' => $offset, 'limit' => $limit, 'item_name' => 'resource'));
        return $resultado;
    }

    public function listByType($type, $offset=0, $limit=12, $key='title', $order='asc') {
        $sql = "SELECT t1.id, t1.url, t1.filepath, t1.filename, t1.extension, t1.activity, t1.created, t1.modified, t2.title, t2.description, t3.name
        FROM resources t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            WHERE t3.name=:type
        ORDER BY $key $order
        LIMIT :offset,:limit";
        $resultado = $this->db->run($sql, array('type' => $type,'offset' => $offset, 'limit' => $limit, 'item_name' => 'resource'));
        return $resultado;
    }

    public function show($id) {
        $sql = "SELECT t1.id, t1.url, t1.filepath, t1.filename, t1.extension, t1.activity, t1.created, t1.modified, t2.title, t2.description, t3.name
        FROM resources t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
        WHERE id=:id";
        $resultado = $this->db->run($sql, array('item_id' => $id, 'item_name' => 'resource'));
        return $resultado;
    }
}
