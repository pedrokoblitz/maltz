<?php

namespace Maltz\Media\Model;

use Maltz\Mvc\Model;
use Maltz\Mvc\Activity;
use Maltz\Mvc\Translateable;
use Maltz\Mvc\ItemRelationships;

/**
 * db de collection pertencente a
 *  - pages
 *  - contents
 *  - books
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

class Collection extends Model
{
    use Activity;
    use Translateable;
    use ItemRelationships;
        
    /*
     * construtor
     *
     *
     * @param db objeto DB
     *
     * return void
     */

    public function __construct($db)
    {
        parent::__construct($db, 'collection', 'collections', 'collection_id');
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
        $sql = "DELETE FROM collections WHERE id=:id";
        $resultado = $this->db->run($sql, array($id));
        $sql = "";
        $resultado = $this->db->run($sql, array());
        return $resultado;
    }

    public function list($offset=0, $limit=12, $key='', $order='asc') {
        $sql = "SELECT t1.id, t1.type_id, t1.activity, t1.modified, t1.created, t2.slug, t2.title, t2.description, t3.name
        FROM collections t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            ORDER BY $key $order
            LIMIT :offset,:limit";
        $resultado = $this->db->run($sql, array('offset' => $offset, 'limit' => $limit));
        return $resultado;
    }

    public function show($id) {
        $sql = "SELECT t1.id, t1.type_id, t1.activity, t1.modified, t1.created, t2.slug, t2.title, t2.description, t3.name
        FROM collections t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            WHERE id=:id";
        $resultado = $this->db->run($sql, array('item_name' => 'collection', 'id' => $id));
        return $resultado;
    }
}
