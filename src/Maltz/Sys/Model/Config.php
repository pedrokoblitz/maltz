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

    public function list($offset, $limit) {
        $sql = "SELECT * FROM config";
        $result = $this->db->run($sql);
        return $result;
    }

    public function show($id) {
        $sql = "SELECT * FROM config WHERE id=$id";
        $result = $this->db->run($sql);
        return $result;
    }

    public function setValue($key, $value)
    {
        $sql = "UPDATE config SET value=\"$value\" WHERE key=\"$key\";";
        $resultado = $this->db->run($sql);
        return $result;
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
}
