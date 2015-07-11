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

    public function display() {
        $sql = "SELECT id, key, value, activity, modified, created FROM config";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function list($offset, $limit) {
        $sql = "SELECT id, key, value, activity, modified, created FROM config LIMIT ?,?";
        $resultado = $this->db->run($sql, array($offset, $limit));
        return $resultado;
    }

    public function show($id) {
        $sql = "SELECT id, key, value, activity, modified, created FROM config WHERE id=?";
        $resultado = $this->db->run($sql, array($id));
        return $resultado;
    }

    public function setValue($key, $value)
    {
        $sql = "UPDATE config SET value=? WHERE key=?";
        $resultadoado = $this->db->run($sql, array($value, $key));
        return $resultado;
    }

    public function getValue($key)
    {
        $sql = "SELECT value FROM config WHERE key=?";
        $resultadoado = $this->db->run($sql, array($key));
        return $resultadoado[0]['value'];
    }

    public function setRefresh($key)
    {
        $sql = "UPDATE config SET value=? WHERE key=?";
        $res = $this->db->run($sql, array('value' => 1, 'key' => $key));
        return $res;
    }

    public function refresh($key)
    {
        $sql = "UPDATE config SET value=? WHERE key=?";
        $res = $this->db->run($sql, array('value' => 0, 'key' => $key));
        return $res;
    }
}
