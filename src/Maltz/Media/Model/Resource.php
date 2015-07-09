<?php

namespace Maltz\Media\Model;

use Maltz\Mvc\Model;

/**
 * db de files pertencentes a albums
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

class Resource extends Model
{
    /*
	 * construtor
	 *
	 * @param db objeto DB
	 *
	 *
	 */
    public function __construct($db)
    {
        parent::__construct($db, 'resource', 'resources', 'resource_id');
    }

    public function list($offset, $limit) {
        $sql = "";
        $result = $this->db->run($sql);
        return $result;
    }

    public function show($id) {
        $sql = "";
        $result = $this->db->run($sql);
        return $result;
    }
}
