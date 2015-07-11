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

    public function list($offset, $limit) {
        $sql = "SELECT (user_id, action, item_name, item_id, created) FROM log LIMIT ?,?";
        $resultado = $this->db->run($sql, array($offset, $limit));
        return $resultado;
    }

    public function insert(Record $record) {
        $sql = "INSERT INTO log (user_id, action, item_name, item_id, created)
            VALUES (?, ?, ?, LAST_INSERT_ID(), NOW())";
        $values = $record->values();
        $resultado = $this->db->run($sql, $values);
        return $resultado;
    }
}
