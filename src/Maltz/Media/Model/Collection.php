<?php

namespace Maltz\Media\Model;

use Maltz\Mvc\Model;
use Maltz\Utils\Pagination;

/**
 * db de collection pertencente a
 *  - pages
 *  - contents
 *  - books
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

class Collection extends Model
{
    /*
     * construtor
     *
     *
     * @param db objeto DB
     *
     * return void
     */

    public function __construct($db)
    {
        parent::__construct($db, 'collection', 'collections', 'collection_id');
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

    public function addResource() {
        $sql = "";
        $result = $this->db->run($sql);
        return $result;
    }

    public function removeResource() {
        $sql = "";
        $result = $this->db->run($sql);
        return $result;
    }

    public function getResources() {
        $sql = "";
        $result = $this->db->run($sql);
        return $result;
    }
}
