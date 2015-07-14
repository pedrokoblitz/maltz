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
        $rules = array(
            'id' => 'int',
            'user_id' => 'int',
            'group_name' => 'string',
            'group_id' => 'int',
            'action' => 'string',
            'item_name' => 'string',
            'item_id' => 'int'
            );
        parent::__construct($db, 'log', 'log', $rules);
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

    public function log($user_id, $group_name, $group_id, $action, $item_name = null, $item_id = null)
    {
        $record = new Record(
            array(
                'user_id' => $user_id,
                'group_name' => $group_name,
                'group_id' => $group_id,
                'action' => $action,
                'item_name' => $item_name,
                'item_id' => $item_id,
                )
            );
        $this->insert($record);
    }
}
