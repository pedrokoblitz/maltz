<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;
use Maltz\Service\Pagination;

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

    public function find($page=1, $per_page=12, $key='created', $order='desc') 
    {
        $pagination = Pagination::paginate($page, $per_page);

        $sql = "SELECT user_id, action, item_name, item_id, created
            FROM log ORDER BY $key $order LIMIT $pagination->offset,$pagination->limit";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function insert(Record $record) 
    {
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
                'group_name' => $name,
                'group_id' => $id,
                )
            );
        $this->insert($record);
    }
}
