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

class Block extends Model
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
        parent::__construct($db, 'block', 'blocks', 'block_id');
    }

    /*
     *
     */
    public function list($offset, $limit) 
    {
        $sql = "SELECT * FROM blocks";
        $result = $this->db->run($sql);
        return $result;
    }

    /*
     *
     */
    public function show($id) {
        $sql = "SELECT * FROM blocks WHERE id=$id";
        $result = $this->db->run($sql);
        return $result;
    }
}
