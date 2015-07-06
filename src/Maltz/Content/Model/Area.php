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

    public function addBlock($block_id)
    {
        
    }

    public function removeBlock($block_id)
    {
        
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
        $blocks = $this->db->run('SELECT * FROM blocks WHERE area_id=:area_id', array('area_id' => $area_id));
        if (!empty($block)) {
            $this->set('data.list', $blocks);
            return true;
        }
        return false;
    }
}
