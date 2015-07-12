<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\Model;

/**
 * Define blocks estáticos para serem guardata no banco
 * e depois aparecerem na barra sidebar ou no rodapé de certas pgs
 *
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author      Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Maltz
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

class Block extends Model
{

    /*
	 *
	 * @param $db DB
	 *
	 * return void
	 *
	 */
    public function __construct($db)
    {
        parent::__construct($db, 'block', 'blocks', 'block_id');
    }

    /*
     * CRUD
     */

    public function insert(Record $record) {
        $fields = $record->getFieldsList();
        $values = $record->getInsertValueString();
        $sql = "INSERT INTO blocks $fields VALUES $values";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }


    public function update(Record $record) {
        $id = $record->get('id');
        $record->remove('id');
        $values = $record->getUpdateValueString();
        $bind = $record->toArray();
        $bind[] = $id;
        $sql = "UPDATE blocks SET $values WHERE id=:id";
        $resultado = $this->db->run($sql, $bind);
        return $resultado;
    }


    public function delete($id) {
        $sql = "DELETE FROM blocks WHERE id=:id";
        $resultado = $this->db->run($sql, array($id));
        return $resultado;
    }

    public function list($offset = 12, $limit = 0, $key='', $order = 'asc') 
    {
        $sql = "SELECT * FROM blocks ORDER BY $key $order LIMIT :offset,:limit";
        $resultado = $this->db->run($sql, array('offset' => $offset, 'limit' => $limit));
        return $resultado;
    }

    public function show($id) {
        $sql = "SELECT * FROM blocks WHERE id=:id";
        $resultado = $this->db->run($sql, array($id));
        return $resultado;
    }
}
