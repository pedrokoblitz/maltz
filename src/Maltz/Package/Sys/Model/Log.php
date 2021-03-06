<?php

namespace Maltz\Package\Sys\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Record;
use Maltz\Mvc\Model;
use Maltz\Service\Pagination;

/**
 * db de relatório de atividade
 *
 * http://ideiasinsolitas.com.br/
 *
 * @copyright Copyright (c) 2012-2013 Pedro Koblitz
 * @author    Pedro Koblitz pedrokoblitz@gmail.com
 * @license   GPL v2
 *
 * @package Maltz
 *
 * @version 0.1 alpha
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
    public function __construct(DB $db)
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

    /**
     * /
     * @param  integer $page     [description]
     * @param  integer $per_page [description]
     * @param  string  $key      [description]
     * @param  string  $order    [description]
     * @return [type]            [description]
     */
    public function find($page = 1, $per_page = 12, $key = 'created', $order = 'desc')
    {
        if (!is_int($page) || !is_int($per_page) || !is_string($key) || !is_string($order)) {
            throw new \Exception("Page and per_page must be integers, key and order must be strings", 001);
        }
        
        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT user_id, group_name, group_id, action, item_name, item_id, nonce, created
            FROM log ORDER BY $key $order LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql);
        return $result;
    }

    /**
     * /
     * @param  Record $record [description]
     * @return [type]         [description]
     */
    public function insert(Record $record)
    {
        $sql = "INSERT INTO log (user_id, group_name, group_id, action, item_name, item_id, nonce, created)
            VALUES (:user_id, :group_name, :group_id, :action, :item_name, :item_id, :nonce, NOW())";
        $values = $record->toArray();
        $result = $this->db->run($sql, $values);
        return $result;
    }

    /**
     * /
     * @param  [type] $user_id    [description]
     * @param  [type] $group_name [description]
     * @param  [type] $group_id   [description]
     * @param  [type] $action     [description]
     * @param  [type] $item_name  [description]
     * @param  [type] $item_id    [description]
     * @param  [type] $nonce      [description]
     * @return [type]             [description]
     */
    public function log($user_id, $group_name, $group_id, $action, $item_name = null, $item_id = null, $nonce = null)
    {
        if (!is_int($user_id) || !is_string($group_name) || !is_int($group_id) || !is_string($action) || !is_string($nonce)) {
            throw new \Exception("Some type is wrong", 1);
        }
        
        $record = new Record(
            array(
                'user_id' => $user_id,
                'group_name' => $group_name,
                'group_id' => $group_id,
                'action' => $action,
                'item_name' => $item_name,
                'item_id' => $item_id,
                'nonce' => $nonce
                )
        );
        $this->insert($record);
    }
}
