<?php

namespace Maltz\Content\Model;

use Maltz\Media\Model\DocumentAdapter;
use Maltz\Media\Model\MediaAdapter;
use Maltz\Mvc\Model;
use Maltz\Utils\Pagination;

/**
 * db de conteúdo dinamico com
 *  - album
 *  - pdf
 *  - categoria/type
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

class Content extends Model
{
    /*
	 * construtor
	 *
	 *
	 * @param objeto DB
	 *
	 * return void
	 */

    public function __construct($db)
    {
        parent::__construct($db, 'content', 'contents', 'id');
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
        $sql = "";
        $resultado = $this->db->run($sql, array());
        $sql = "";
        $resultado = $this->db->run($sql, array());
        return $resultado;
    }

    public function show($id) {
        $sql = "SELECT t1.type_id, t1.activity, t1.date_pub, t1.created, t1.modified, t2.name, t2.title, t2.subtitle, t2.description, t2.body, t3.name
            FROM contents t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            JOIN types t3
                ON t1.type_id=t3.id
            WHERE t.1=:id";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function list($offset=0, $limit=12, $key='modified', $order='asc') {
        $sql = "SELECT t1.type_id, t1.activity, t1.date_pub, t1.created, t1.modified, t2.name, t2.title, t2.subtitle, t2.description, t2.body, t3.name
            FROM contents t1
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

    public function listByType($type, $offset=0, $limit=12, $key='modified', $order='asc') {
        $sql = "SELECT t1.type_id, t1.activity, t1.date_pub, t1.created, t1.modified, t2.name, t2.title, t2.subtitle, t2.description, t2.body, t3.name
            FROM contents t1
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
}
