<?php

namespace Maltz\Package\SiteBuilding\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\ModelFeature\Translatable;
use Maltz\Service\Pagination;

/**
 * Define blocks estáticos para serem guardata no banco
 * e depois aparecerem na barra sidebar ou no rodapé de certas pgs
 *
 * http://ideiasinsolitas.com.br/
 *
 * @copyright Copyright (c) 2012-2013 Pedro Koblitz
 * @author    Pedro Koblitz pedrokoblitz@gmail.com
 * @license   GPL v2
 *
 * @package Maltz
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

class Block extends Model
{
    use Translatable;
    
    /*
    *
    * @param $db DB
    *
    * return void
    *
    */
    public function __construct(DB $db)
    {
        $rules = array(
            'id' => 'int',
            'area_id' => 'int',
            'user_id' => 'int',
            'slug' => 'slug',
            'title' => 'string',
            'body' => 'textarea',
            );
        parent::__construct($db, 'block', 'blocks', $rules);
    }

    /*
     * CRUD
     */

    public function insert(Record $record)
    {
        $fields = $record->getFieldsList();
        $values = $record->getInsertValueString();
        $sql = "INSERT INTO blocks $fields VALUES $values";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }


    public function update(Record $record)
    {
        $id = $record->get('id');
        if (!$id) {
            throw new \Exception("Id must be set", 1);
        }
        $values = $record->getUpdateValueString();
        $sql = "UPDATE blocks SET $values WHERE id=:id";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }


    public function delete($id)
    {
        $sql = "DELETE FROM blocks WHERE id=:id";
        $result = $this->db->run($sql, array('id' => $id));
        return $result;
    }

    public function display($key = 'title', $order = 'asc', $lang = 'pt-br')
    {
        $sql = "SELECT t1.id, t1.area_id, t2.title, t2.description 
        FROM blocks 
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            WHERE t2.language=:lang
            AND t1.activity > 0
            ORDER BY $key $order";
        $result = $this->db->run($sql, array('item_name' => 'block', 'lang' => $lang));
        return $result;
    }

    public function find($page = 1, $per_page = 12, $key = 'title', $order = 'asc', $lang = 'pt-br')
    {
        $pagination = Pagination::paginate($page, $per_page);

        $sql = "SELECT t1.id, t1.area_id, t2.title, t2.description 
        FROM blocks 
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            WHERE t2.language=:lang
            AND t1.activity > 0
            ORDER BY $key $order 
            LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql, array('item_name' => 'block', 'lang' => $lang));
        return $result;
    }

    public function show($id, $lang = 'pt-br')
    {
        $sql = "SELECT t1.id, t1.area_id, t2.title, t2.description 
        FROM blocks t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            WHERE id=:id
            AND t2.language=:lang
            AND t1.activity > 0";
        $result = $this->db->run($sql, array('item_name' => 'block', 'id' => $id, 'lang' => $lang));
        return $result;
    }
}
