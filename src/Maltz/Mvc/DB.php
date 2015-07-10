<?php

namespace Maltz\Mvc;

/**
 * Adaptador do \PDO
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

class DB extends \PDO
{

    private $error;
    private $sql;
    private $bind;
    private $errorCallbackFunction;
    private $errorMsgFormat;

    /*
	 * $db = new DB($dsn, $user, $passwd);
	 *
	 * @param $dsn
	 * @param $user
	 * @param $passwd
	 */
    public function __construct($dsn, $user = "", $passwd = "")
    {
        $options = array(
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        );

        try {
            parent::__construct($dsn, $user, $passwd, $options);
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
        }
    }


    /*
	 *
	 * @param $table
	 * @param $where
	 * @param $bind
	 *
	 */
    public function delete($table, $where, $bind = "")
    {
        $sql = "DELETE FROM " . $table . " WHERE " . $where . ";";
        return $this->run($sql, $bind);
    }

    /*
	 *
	 *
	 * @param $table
	 * @param $info
	 *
	 */
    private function filter($table, $info)
    {
        $driver = $this->getAttribute(\PDO::ATTR_DRIVER_NAME);
        if ($driver == 'sqlite') {
            $sql = "PRAGMA table_info('" . $table . "');";
            $key = "name";
        } elseif ($driver == 'mysql') {
            $sql = "DESCRIBE " . $table . ";";
            $key = "Field";
        } else {
            $sql = "SELECT column_name FROM information_schema.columns WHERE table_name = '" . $table . "';";
            $key = "column_name";
        }

        if (false !== ($list = $this->run($sql))) {
            $fields = array();
            foreach ($list as $record) {
                $fields[] = $record[$key];
            }
            return array_values(array_intersect($fields, array_keys($info)));
        }
        return array();
    }

    /*
	 *
	 *
	 * @param bind
	 *
	 *
	 */
    private function cleanup($bind)
    {
        if (!is_array($bind)) {
            if (!empty($bind)) {
                $bind = array($bind);
            } else {
                $bind = array();
            }

        }

        foreach ($bind as $key => $val) {
            $bind[$key] = stripslashes($val);
        }

        return $bind;
    }

    /*
	 *
	 *
	 * @param $table
	 * @param $info
	 *
	 */
    public function insert($table, $info)
    {
        $fields = $this->filter($table, $info);
        $sql = "INSERT INTO " . $table . " (" . implode($fields, ", ") . ") VALUES (:" . implode($fields, ", :") . ");";
        $bind = array();
        foreach ($fields as $field) {
            $bind[":{$field}"] = $info[$field];
        }

        $data = $this->run($sql, $bind);
        if ($data === false || $data === null || $data === array() || $data === '' || $data === 0) {
            $data = null;
        }
        return $data;
    }

    /*
	 *
	 *
	 * @param $sql
	 * @param $bind
	 *
	 */
    public function run($sql, $bind = "")
    {

//var_dump($sql);

        $this->sql = trim($sql);
        $this->bind = $this->cleanup($bind);
        $this->error = "";

        try {
            $pdostmt = $this->prepare($this->sql);
            if ($pdostmt->execute($this->bind) !== false) {
                if (preg_match("/^(" . implode("|", array("select", "describe", "pragma")) . ") /i", $this->sql)) {
                    $data = $pdostmt->fetchAll(\PDO::FETCH_ASSOC);
                    return new Result(array('records' => $data, 'model.success' => true));
                
                } elseif (preg_match("/^(count) /i", $this->sql)) {
                    $data = $pdostmt->fetchAll(\PDO::FETCH_ASSOC);
                    return new Result(array('count' => $data['COUNT(id)'], 'model.success' => true));
                
                } elseif (preg_match("/^(insert) /i", $this->sql)) {
                    $last = \PDO::lastInsertId();
                    return new Result(array('last_insert_id' => $last, 'model.success' => true));
                
                } else {
                    return new Result(array('success' => true));
                }
            }
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
            return new Result('model.success' => false, 'model.error_message' => $e->getMessage());
        }
    }

    /*
	 *
	 * @param $table
	 * @param $info
	 * @param $where
	 * @param bind
	 */
    public function update($table, $info, $where, $bind = "")
    {
        $fields = $this->filter($table, $info);
        $fieldSize = count($fields);

        $sql = "UPDATE " . $table . " SET ";
        for ($f = 0; $f < $fieldSize; ++$f) {
            if ($f > 0) {
                $sql .= ", ";
            }

            $sql .= $fields[$f] . "=:update_" . $fields[$f];
        }
        $sql .= " WHERE " . $where . ";";

        $bind = $this->cleanup($bind);
        foreach ($fields as $field) {
            $bind[":update_$field"] = $info[$field];
        }
        $data = $this->run($sql, $bind);
        if ($data === false || $data === null || $data === array() || $data === '' || $data === 0) {
            return null;
        }
        return $data;
    }

    /*
	 *
	 * @param $table
	 * @param $pk
	 */
    public function count($table)
    {
        $sql = "SELECT COUNT(id) FROM " . $table . ";";
        $data = $this->run($sql);
        if ($data === false || $data === null || $data === array() || $data === '' || $data === 0) {
            return null;
        }
        return $data;
    }

    public function foundRows()
    {
        $sql = "SELECT FOUND_ROWS;";
        $data = $this->run($sql);
        if ($data === false || $data === null || $data === array() || $data === '' || $data === 0) {
            return null;
        }
        return $data;
    }
}
