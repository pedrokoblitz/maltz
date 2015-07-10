<?php

namespace Maltz\Content\Model;

use Maltz\Media\Model\DocumentAdapter;
use Maltz\Media\Model\MediaAdapter;
use Maltz\Mvc\Model;
use Maltz\Utils\Pagination;

/**
 * db de conteúdo dinamico com
 *  - album
 *  - pdf
 *  - categoria/type
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

class Content extends Model
{
    /*
	 * construtor
	 *
	 *
	 * @param objeto DB
	 *
	 * return void
	 */

    public function __construct($db)
    {
        parent::__construct($db, 'content', 'contents', 'content_id');
    }

    public function insert() {
        $sql = "";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function update() {
        $sql = "";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function show($id) {
        $sql = "SELECT t1.content_type_id, t1.activity, t1.date_pub, t1.created 
        FROM contents t1";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function list($offset, $limit) {
        $sql = "SELECT t1.content_type_id, t1.activity, t1.date_pub, t1.created 
        FROM contents t1";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function delete() {
        $sql = "SELECT t1.content_type_id, t1.activity, t1.date_pub, t1.created 
        FROM contents t1 WHERE id=$id";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function addResources() {
        $sql = "SELECT t1.content_type_id, t1.activity, t1.date_pub, t1.created 
        FROM contents t1";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function removeResources() {
        $sql = "SELECT t1.content_type_id, t1.activity, t1.date_pub, t1.created 
        FROM contents t1";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function getResources() {
        $sql = "SELECT t1.content_type_id, t1.activity, t1.date_pub, t1.created 
        FROM contents t1";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function addCollections() {
        $sql = "SELECT t1.content_type_id, t1.activity, t1.date_pub, t1.created 
        FROM contents t1";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function removeCollections() {
        $sql = "SELECT t1.content_type_id, t1.activity, t1.date_pub, t1.created 
        FROM contents t1";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function getCollections() {
        $sql = "SELECT t1.content_type_id, t1.activity, t1.date_pub, t1.created 
        FROM contents t1";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function addTerms() {
        $sql = "SELECT t1.content_type_id, t1.activity, t1.date_pub, t1.created 
        FROM contents t1";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function removeTerms() {
        $sql = "SELECT t1.content_type_id, t1.activity, t1.date_pub, t1.created 
        FROM contents t1";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function getTerms() {
        $sql = "SELECT t1.content_type_id, t1.activity, t1.date_pub, t1.created 
        FROM contents t1";
        $resultado = $this->db->run($sql);
        return $resultado;
    }
}
