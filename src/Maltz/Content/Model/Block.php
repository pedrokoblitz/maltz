<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\Translatable;
use Maltz\Service\Pagination;

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
    use Translatable;
    
    /*
	 *
	 * @param $db DB
	 *
	 * return void
	 *
	 */
    public function __construct($db)
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

    public function insert(Record $record) {
        return $resultado;
    }


    public function update(Record $record) {
        return $resultado;
    }


    public function delete($id) {
        $sql = "DELETE FROM blocks WHERE id=:id";
        $resultado = $this->db->run($sql, array('id' => $id));
        return $resultado;
    }

    public function display($key='title', $order = 'asc') 
    {
        $sql = "SELECT t1.id, t1.area_id, t2.title, t2.description 
        FROM blocks 
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            ORDER BY $key $order";
        $resultado = $this->db->run($sql, array('item_name' => 'block'));
        return $resultado;
    }

    public function find($page=1, $per_page=12, $key='title', $order = 'asc') 
    {
        $pagination = Pagination::paginate($page, $per_page);

        $sql = "SELECT t1.id, t1.area_id, t2.title, t2.description 
        FROM blocks 
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            ORDER BY $key $order 
            LIMIT $pagination->offset,$pagination->limit";
        $resultado = $this->db->run($sql, array('item_name' => 'block', ));
        return $resultado;
    }

    public function show($id) 
    {
        $sql = "SELECT t1.id, t1.area_id, t2.title, t2.description 
        FROM blocks t1
            JOIN translations t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            WHERE id=:id";
        $resultado = $this->db->run($sql, array('item_name' => 'block', 'id' => $id));
        return $resultado;
    }
}
