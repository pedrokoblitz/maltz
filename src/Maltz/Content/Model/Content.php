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
        $sql = "SELECT * FROM contents";
        $result = $this->db->run($sql);
        return $result;
    }

    public function update() {
        $sql = "SELECT * FROM contents";
        $result = $this->db->run($sql);
        return $result;
    }

    public function show($id) {
        $sql = "SELECT * FROM contents";
        $result = $this->db->run($sql);
        return $result;
    }

    public function list($offset, $limit) {
        $sql = "SELECT * FROM contents";
        $result = $this->db->run($sql);
        return $result;
    }

    public function delete() {
        $sql = "SELECT * FROM contents WHERE id=$id";
        $result = $this->db->run($sql);
        return $result;
    }

    public function addResources() {
        $sql = "SELECT * FROM contents";
        $result = $this->db->run($sql);
        return $result;
    }

    public function removeResources() {
        $sql = "SELECT * FROM contents";
        $result = $this->db->run($sql);
        return $result;
    }

    public function getResources() {
        $sql = "SELECT * FROM contents";
        $result = $this->db->run($sql);
        return $result;
    }

    public function addCollections() {
        $sql = "SELECT * FROM contents";
        $result = $this->db->run($sql);
        return $result;
    }

    public function removeCollections() {
        $sql = "SELECT * FROM contents";
        $result = $this->db->run($sql);
        return $result;
    }

    public function getCollections() {
        $sql = "SELECT * FROM contents";
        $result = $this->db->run($sql);
        return $result;
    }

    public function addTerms() {
        $sql = "SELECT * FROM contents";
        $result = $this->db->run($sql);
        return $result;
    }

    public function removeTerms() {
        $sql = "SELECT * FROM contents";
        $result = $this->db->run($sql);
        return $result;
    }

    public function getTerms() {
        $sql = "SELECT * FROM contents";
        $result = $this->db->run($sql);
        return $result;
    }
}
