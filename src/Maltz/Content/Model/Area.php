<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\Activity;
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
    public function __construct(DB $db)
    {
        $rules = array(
            'id' => 'int',
            'name' => 'string',
            'activity' => 'int',
            );
        parent::__construct($db, 'area', 'areas', $rules);
    }

    /*
     * CRUD
     */

    public function insert(Record $record)
    {
        $fields = $record->getFieldsList();
        $values = $record->getInsertValueString();
        $sql = "INSERT INTO areas $fields VALUES $values";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }


    public function update(Record $record)
    {
        $values = $record->getUpdateValueString();
        $sql = "UPDATE areas SET $values WHERE id=:id";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    public function display($key = 'name', $order = 'asc')
    {
        if (!is_string($key) || !is_string($order)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "SELECT id, name, activity 
        FROM areas
            ORDER BY $key $order
            WHERE activity > 0";
        $result = $this->db->run($sql);
        return $result;
    }


    public function find($page = 1, $per_page = 12, $key = 'name', $order = 'asc')
    {
        if (!(int) $page || !(int) $per_page || !is_string($key) || !is_string($order)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT id, name, activity 
        FROM areas
            ORDER BY $key $order
            LIMIT $pagination->offset,$pagination->limit
        WHERE activity > 0";
        $result = $this->db->run($sql, array('item_name' => 'area'));
        return $result;
    }

    public function show($id)
    {
        if (!(int) $id) {
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "SELECT id, name, activity FROM areas
            WHERE id=:id
                AND activity > 0";
        $result = $this->db->run($sql, array('id' => $id));
        return $result;
    }

    /*
     * RELATIONSHIPS
     */

    public function addBlock($area_id, $block_id)
    {
        if (!(int) $area_id || !(int) $block_id) {
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "UPDATE blocks SET area_id=:area_id WHERE id=:block_id";
        $result = $this->db->run($sql, array('area_id' => $area_id, 'block_id' => $block_id));
        return $result;
    }

    public function removeBlock($block_id)
    {
        if (!(int) $block_id) {
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "UPDATE blocks SET area_id=:area_id WHERE id=:block_id";
        $result = $this->db->run($sql, array('area_id' => 0, 'block_id' => $block_id));
        return $result;
    }

    public function getBlocks($area_id)
    {
        if (!(int) $area_id) {
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "SELECT t1.id, t1.area_id, t1.activity, t2.slug, t2.title, t2.description
        FROM blocks t1
            JOIN translations t2
                ON t2.item_name=:item_name
                AND t2.item_id=t1.id
            WHERE t1.area_id=:area_id
                AND t1.activity > 0";
        $result = $this->db->run($sql, array('item_name' => 'block', 'area_id' => $area_id));
        return $result;
    }
}
