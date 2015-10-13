<?php

namespace Maltz\Package\Sys\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\ModelFeature\Activity;
use Maltz\Mvc\ValueFormat;
use Maltz\Service\Pagination;

/**
 * db de configuração
 * guarda keys e valuees que são carregados a cada requisição
 *
 * http://ideiasinsolitas.com.br/
 *
 * @copyright Copyright (c) 2012-2013 Pedro Koblitz
 * @author    Pedro Koblitz pedrokoblitz@gmail.com
 * @license   GPL v2
 *
 * @package Maltz
 *
 * @version 0.1 alpha
 */

/*
 *
 * @param objeto DB
 *
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
    public function __construct(DB $db)
    {
        $rules = array(
            'id' => 'int',
            'key' => 'string',
            'value' => 'string',
            'format' => 'int',
            'activity' => 'int',
            );
        parent::__construct($db, 'config', 'config', 'config_id', $rules);
    }

    /*
     * CRUD
     */

    public function processRecord(Record $record)
    {
        if (!$record->has('activity')) {
            $record->set('activity', 2);
        }
        return $record;
    }

    public function insert(Record $record)
    {
        $sql = "INSERT INTO config (`key`, value, format, activity, created, modified) VALUES (:key, :value, :activity, NOW(), NOW())";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    public function update(Record $record)
    {
        $sql = "UPDATE config SET activity=:activity, value=:value, modified=NOW() 
            WHERE key=:key";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    public function display()
    {
        $sql = "SELECT id, `key`, value, format, activity, modified, created 
            FROM config";
        $result = $this->db->run($sql);
        return $result;
    }

    public function find($page = 1, $per_page = 12, $key = 'key', $order = 'asc')
    {
        if (!is_int($page) || !is_int($per_page) || !is_string($key) || !is_string($order)) {
            throw new \Exception("Page and per_page must be integers, key and order must be strings.", 001);
        }
        
        $pagination = Pagination::paginate($page, $per_page);
        $sql = "SELECT id, `key`, value, format, activity, modified, created 
            FROM config 
            ORDER BY $key $order 
            LIMIT $pagination->offset,$pagination->limit";
        $result = $this->db->run($sql, array());
        return $result;
    }

    public function show($id)
    {
        if (!is_int($id) ) {
            throw new \Exception("Id must be integer.", 002);
        }
        
        $sql = "SELECT id, `key`, value, activity, modified, created 
            FROM config 
            WHERE id=:id";
        $result = $this->db->run($sql, array($id));
        return $result;
    }

    /*
     * APP SPECIFIC
     */

    public function setValue($key, $value)
    {
        if (!is_string($key) || !is_string($value)) {
            throw new \Exception("Key and value must be strings", 003);
        }
        
        $sql = "UPDATE config SET value=:value 
            WHERE key=:key";
        $result = $this->db->run($sql, array('value' => $value, 'key' => $key));
        return $result;
    }

    public function getValue($key)
    {
        if (!is_string($key)) {
            throw new \Exception("Key must be string.", 004);
        }
        
        $sql = "SELECT value FROM config 
            WHERE key=:key";
        $record = $this->db->run($sql, array($key))->getFirstRecord();
        if (!$record instanceof Record) {
            throw new \Exception("Invalid record", 1);
        }
        return $record->get('value');
    }

    public function setRefresh($key)
    {
        if (!is_string($key)) {
            throw new \Exception("Key must be string.", 005);
        }
        
        $sql = "UPDATE config SET value=:value 
            WHERE key=:key";
        $result = $this->db->run($sql, array('value' => 1, 'key' => $key));
        return $result;
    }

    public function refresh($key)
    {
        if (!is_string($key)) {
            throw new \Exception("Key must be string.", 006);
        }
        
        $sql = "UPDATE config SET value=:value 
            WHERE key=:key";
        $result = $this->db->run($sql, array('value' => 0, 'key' => $key));
        return $result;
    }
}
