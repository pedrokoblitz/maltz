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

class ResourceType extends Model
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
        parent::__construct($db, 'resource_type', 'resource_types', 'resource_type_id');
    }

    public function list($offset, $limit) {
        $sql = "SELECT * FROM resource_types";
        $result = $this->db->run($sql);
        return $result;
    }

    public function show($id) {
        $sql = "SELECT * FROM resource_types WHERE id=$id";
        $result = $this->db->run($sql);
        return $result;
    }
}
