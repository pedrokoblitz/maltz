<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;

/**
 * db de configuração
 * guarda keys e valuees que são carregados a cada requisição
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

class Config extends Model
{
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
        parent::__construct($db, 'config', 'config', 'config_id');
    }

    /*
     * descobre quais categorias estao sendo utilizadas
     *
     * return array
     *
     *
     */
    public function setValue($key, $value)
    {
        $sql = "UPDATE config SET value=\"$value\" WHERE key=\"$key\";";
        $resultado = $this->db->run($sql);
    }

    public function getValue($key)
    {
        $sql = "SELECT value FROM config WHERE key=\"$key\";";
        $resultado = $this->db->run($sql);
        return $resultado[0]['value'];
    }

    public function setRefresh($key)
    {
        $sql = "UPDATE config SET value=\"1\" WHERE key=:key";
        $res = $this->db->run($sql, array('key' => $key));
        if ($res) {
            return $res;
        }
        return false;
    }

    public function refresh($key)
    {
        $sql = "UPDATE config SET value=\"0\" WHERE key=:key";
        $res = $this->db->run($sql, array('key' => $key));
        if ($res) {
            return $res;
        }
        return false;
    }



    /*
	 * descobre quais categorias estao sendo utilizadas
	 *
	 * return array
	 *
	 *
	 */
    public function types()
    {
        $sql = "SELECT DISTINCT type FROM contents;";
        $resultado = $this->db->run($sql);
        $types = array();
        foreach ($resultado as $r) {
            $types[] = $r['type'];
        }
        $this->set('data.list', $types);
        return $types;
    }
}
