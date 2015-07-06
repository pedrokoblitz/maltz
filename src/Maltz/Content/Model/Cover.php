<?php

namespace Maltz\Content\Model;

use Maltz\Mvc\Model;
use Maltz\Sys\Model\Rss;

/**
 *
 *
 * ESSE COMPONENTE NAO ACESSA DIRETAMENTE O BANCO DE DADOS
 * NAO DEVE ESTENDER O CTRL
 *
 * Utiliza outros ctrls para criar a cover do frontend
 *
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

class Cover extends Model
{
    protected $db;

    /*
	 * construtor
	 *
	 * @param $db DB
	 *
	 * return void
	 *
	 */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /*
	 *
	 * carregar a list de contents
	 *
	 * @param int $n - numero de pgs
	 *
	 * return void
	 *
	 */
    public function setContents($n = 9)
    {
        $sql = "SELECT t1.*, t2.name, t2.extension FROM contents t1 LEFT JOIN files t2 ON t1.cover_id=t2.id LIMIT " . $n;
        $resultado = $this->db->run($sql);
        $this->set('data.contents', $resultado);
    }

    /*
	 *
	 * carregar o rss do tumblr
	 *
	 * @param int $n - numero de pgs
	 *
	 * return void
	 *
	 */
    public function setBlog($n = 3, $url = "")
    {
        $sql = "";
        $bind = array();

        $rss = new Rss($url);
        $rss->getFeed($n);
        $this->set('data.blog', $rss->all());
    }

    /*
	 *
	 * carregar as albums
	 * (depreciado)
	 *
	 * return void
	 *
	 */
    public function setAlbums($n = 5)
    {
        $sql = "SELECT t1.*, t2.name, t2.extension FROM albums t1 JOIN files t2 ON t1.cover_id=t2.id LIMIT " . $n;
        $resultado = $this->db->run($sql);
        $this->set('data.albums', $resultado);
    }
}
