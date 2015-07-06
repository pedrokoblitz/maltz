<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;
use Maltz\Content\Model\Page;
use Maltz\Content\Model\Book;
use Maltz\Content\Model\Content;
use Maltz\Media\Model\Album;


/**
 * ESSE COMPONENTE NAO ACESSA DIRETAMENTE O BANCO DE DADOS
 * NAO DEVE ESTENDER O CTRL
 *
 * Utiliza outros ctrls para criar a cover do backend
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

class Panel extends Model
{

    // objeto DB
    protected $db;

    /*
	 *
	 * construtor
	 *
	 * @param $db
	 *
	 *
	 */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /*
	 *
	 * carrega data do log
	 *
	 * @param $num int
	 *
	 * return void
	 *
	 */
    public function setLog($num = 5)
    {
        $sql = "SELECT * FROM log LIMIT " . $num;
        $result = $this->db->run($sql);
        $this->set('data.log', $result);
    }

    /*
	 *
	 * carrega data dos contents
	 *
	 * @param $num int
	 *
	 * return void
	 *
	 */
    public function setContents($num = 5)
    {
        $sql = "SELECT * FROM contents LIMIT " . $num;
        $result = $this->db->run($sql);
        $this->set('data.contents', $result);
    }

    /*
	 *
	 * carrega data das albums
	 *
	 * @param $num int
	 *
	 * return void
	 *
	 */
    public function setAlbums($num = 5)
    {
        $sql = "SELECT * FROM albums LIMIT " . $num;
        $result = $this->db->run($sql);
        $this->set('data.albums', $result);
    }
}
