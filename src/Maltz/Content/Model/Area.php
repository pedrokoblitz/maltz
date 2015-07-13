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
        $sql = "INSERT INTO resources";
        $resultado = $this->db->run($sql, array());
        return $resultado;
    }


    public function update(Record $record) {
        $sql = "DELETE FROM ";
        $resultado = $this->db->run($sql, array());
        return $resultado;
    }


    public function delete($id) {
        $sql = "DELETE FROM ";
        $resultado = $this->db->run($sql, array());
        return $resultado;
    }

    public function list($offset=0, $limit=12, $key='', $order='asc') {
        $sql = "SELECT t1.name, t1.activity, t2.title, t2.description FROM areas t1
            JOIN translations t2
                ON t2.item_name=:item_name

                AND t2.item_id=t1.id
            ORDER BY $key $order
            LIMIT :offset,:limit";
        $resultado = $this->db->run($sql, array('area', $key, $order, $offset, $limit));
        return $resultado;
    }

    public function show($id) {
        $sql = "SELECT t1.name, t1.activity, t2.title, t2.description FROM areas t1
            JOIN translations t2
                ON t2.item_name=:item_name

                AND t2.item_id=t1.id
            WHERE t1.id=:id
";
        $resultado = $this->db->run($sql, array('area', $id));
        return $resultado;
    }

    /*
     * RELATIONSHIPS
     */

    public function addBlock()
    {
        $sql = "UPDATE blocks SET area_id=:area_id WHERE id=:id";
        $resultado = $this->db->run($sql, array($area_id, $id));
        return $resultado;
    }

    public function removeBlock($block_id)
    {
        $sql = "UPDATE blocks SET area_id=:area_id WHERE id=:id";
        $resultado = $this->db->run($sql, array(0, $id));
        return $resultado;
    }

    public function getBlocks($area_id)
    {
        $sql = "SELECT t1.area_id, t1.activity, t2.slug, t2.title, t2.description 
        FROM blocks t1
            JOIN translations t2
                ON t2.item_name=:item_name

                AND t2.item_id=t1.id
            WHERE t1.area_id=:area_id
";
        $resultado = $this->db->run($sql, array('block', $area_id));
        return $resultado;
    }

    /*
     * 
     */

}
