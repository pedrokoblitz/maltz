<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\Model;

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
     *
     */
    public function list($offset, $limit) {
        $sql = "SELECT t1.*, t2.* FROM areas t1
        JOIN translations t2
        ON t2.item_name=\"area\"
        AND t2.item_id=t1.id";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    /*
     *
     */
    public function show($id) {
        $sql = "SELECT t1.*, t2.* FROM areas t1
        JOIN translations t2
        ON t2.item_name=\"area\"
        AND t2.item_id=t1.id
        WHERE id=$id";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function addBlock()
    {
        $sql = "UPDATE blocks SET area_id=$area_id WHERE id=$block_id";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function removeBlock($block_id)
    {
        $sql = "DELETE * FROM areas";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    /*
     *
     * mostra a area
     *
     * @param $area string
     *
     * return void
     *
     */
    public function getBlocks($area_id)
    {
        $sql = "SELECT t1.*, t2.* FROM blocks t1
        JOIN translations t2
        ON t2.item_name=\"blocks\"
        AND t2.item_id=t1.id
        WHERE area_id=:area_id";
        $resultado = $this->db->run($sql, array('area_id' => $area_id));
        return $resultado;
    }
}
