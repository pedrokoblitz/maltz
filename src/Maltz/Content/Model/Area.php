<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\Model;
use Maltz\Mvc\Activity;

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

class Area extends Model
{
    use Activity;

    /*
     *
     * @param $db DB
     *
     * return void
     *
     */
    public function __construct($db)
    {
        parent::__construct($db, 'area', 'areas', 'area_id');
    }

    /*
     * CRUD
     */

    public function insert(Record $record) {
        $fields = $record->getFieldsList();
        $values = $record->getInsertValueString();
        $sql = "INSERT INTO areas $fields VALUES $values";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }


    public function update(Record $record) {
        $values = $record->getUpdateValueString();
        $sql = "UPDATE areas SET $values WHERE id=:id";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }

    public function display($key='name', $order='asc') {
        $sql = "SELECT id, name, activity 
        FROM areas
            ORDER BY $key $order";
        $resultado = $this->db->run($sql);
        return $resultado;
    }


    public function list($offset=0, $limit=12, $key='name', $order='asc') {
        $sql = "SELECT id, name, activity 
        FROM areas
            ORDER BY $key $order
            LIMIT :offset,:limit";
        $resultado = $this->db->run($sql, array('offset' => $offset, 'limit' => $limit, 'item_name' => 'area'));
        return $resultado;
    }

    public function show($id) {
        $sql = "SELECT id, name, activity FROM areas
            WHERE t1.id=:id";
        $resultado = $this->db->run($sql, array('id' => $id));
        return $resultado;
    }

    /*
     * RELATIONSHIPS
     */

    public function addBlock($area_id, $block_id)
    {
        $sql = "UPDATE blocks SET area_id=:area_id WHERE id=:block_id";
        $resultado = $this->db->run($sql, array('area_id' => $area_id, 'block_id' => $block_id));
        return $resultado;
    }

    public function removeBlock($block_id)
    {
        $sql = "UPDATE blocks SET area_id=:area_id WHERE id=:block_id";
        $resultado = $this->db->run($sql, array('area_id' => 0, 'block_id' => $block_id));
        return $resultado;
    }

    public function getBlocks($area_id)
    {
        $sql = "SELECT t1.id AS id, t1.area_id AS area_id, t1.activity AS activity, t2.slug AS slug, t2.title AS title, t2.description AS description
        FROM blocks t1
            JOIN translations t2
                ON t2.item_name=:item_name
                AND t2.item_id=t1.id
            WHERE t1.area_id=:area_id";
        $resultado = $this->db->run($sql, array('item_name' => 'block', 'area_id' => $area_id));
        return $resultado;
    }

    /*
     * 
     */

}
