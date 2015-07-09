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
        $result = $this->db->run($sql);
    }

    public function update() {
        $sql = "";
        $result = $this->db->run($sql);
    }

    public function show() {
        $sql = "";
        $result = $this->db->run($sql);
    }

    public function list() {
        $sql = "";
        $result = $this->db->run($sql);
    }

    public function delete() {
        $sql = "";
        $result = $this->db->run($sql);
    }

    public function addResources() {
        $sql = "";
        $result = $this->db->run($sql);
    }

    public function removeResources() {
        $sql = "";
        $result = $this->db->run($sql);
    }

    public function getResources() {
        $sql = "";
        $result = $this->db->run($sql);
    }

    public function addCollections() {
        $sql = "";
        $result = $this->db->run($sql);
    }

    public function removeCollections() {
        $sql = "";
        $result = $this->db->run($sql);
    }

    public function getCollections() {
        $sql = "";
        $result = $this->db->run($sql);
    }

    public function addTerms() {
        $sql = "";
        $result = $this->db->run($sql);
    }

    public function removeTerms() {
        $sql = "";
        $result = $this->db->run($sql);
    }

    public function getTerms() {
        $sql = "";
        $result = $this->db->run($sql);
    }
}
