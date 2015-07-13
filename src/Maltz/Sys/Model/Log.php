<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;

/**
 * db de relatório de atividade
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
class Log extends Model
{

    /*
	 *
	 * construtor
	 *
	 * @param db objeto DB
	 *
	 */
    public function __construct($db)
    {
        parent::__construct($db, 'log', 'log', 'log_id');
    }

    /*
     * CRUD
     */

    public function list($offset=0, $limit=12, $key='created', $order='desc') {
        $sql = "SELECT (user_id, action, item_name, item_id, created) FROM log ORDER BY $key $order LIMIT :offset,:limit";
        $resultado = $this->db->run($sql, array('offset' => $offset, 'limit' => $limit));
        return $resultado;
    }

    public function insert(Record $record) {
        $sql = "INSERT INTO log (user_id, action, item_name, item_id, created)
            VALUES (:user_id, :action, :item_name, :item_id, NOW())";
        $values = $record->toArray();
        $resultado = $this->db->run($sql, $values);
        return $resultado;
    }

    public function log($user_id, $action, $name, $id)
    {
        $record = new Record(
            array(
                'user_id' => $user_id,
                'action' => $action,
                'item_name' => $name,
                'item_id' => $id,
                )
            );
        $this->insert($record);
    }
}
