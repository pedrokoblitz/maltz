<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\Activity;
use Maltz\Service\Pagination;

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
    use Activity;

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
     * CRUD
     */

    public function insert(Record $record) 
    {
        if (!$record->has('activity')) {
            $record->set('activity', 2);
        }
        $sql = "INSERT INTO config (key, value, activity, created, modified) VALUES (:key, :value, :activity, NOW(), NOW())";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }

    public function update(Record $record) 
    {
        $sql = "UPDATE config SET value=:value, modified=NOW() WHERE key=:key";
        $resultado = $this->db->run($sql, $record->toArray());
        return $resultado;
    }

    public function display() 
    {
        $sql = "SELECT id, key, value, activity, modified, created FROM config";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function find($page=1, $per_page=12, $key='key', $order='asc') 
    {
        $pagination = Pagination::paginate($page, $per_page);

        $sql = "SELECT id, key, value, activity, modified, created FROM config ORDER BY $key $order LIMIT $pagination->offset,$pagination->limit";
        $resultado = $this->db->run($sql, array());
        return $resultado;
    }

    public function show($id) 
    {
        $sql = "SELECT id, key, value, activity, modified, created FROM config WHERE id=:id";
        $resultado = $this->db->run($sql, array($id));
        return $resultado;
    }

    /*
     * APP SPECIFIC
     */

    public function setValue($key, $value)
    {
        $sql = "UPDATE config SET value=:value WHERE key=:key";
        $resultadoado = $this->db->run($sql, array('value' => $value, 'key' => $key));
        return $resultado;
    }

    public function getValue($key)
    {
        $sql = "SELECT value FROM config WHERE key=:key";
        $resultadoado = $this->db->run($sql, array($key));
        return $resultadoado[0]['value'];
    }

    public function setRefresh($key)
    {
        $sql = "UPDATE config SET value=:value WHERE key=:key";
        $res = $this->db->run($sql, array('value' => 1, 'key' => $key));
        return $res;
    }

    public function refresh($key)
    {
        $sql = "UPDATE config SET value=:value WHERE key=:key";
        $res = $this->db->run($sql, array('value' => 0, 'key' => $key));
        return $res;
    }
}
