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
        $this->run($sql, $bind);
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
            return null;
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
    public function run($sql, $bind = "", $single = false)
    {

//var_dump($sql);

        $this->sql = trim($sql);
        $this->bind = $this->cleanup($bind);
        $this->error = "";

        try {
            $pdostmt = $this->prepare($this->sql);
            if ($pdostmt->execute($this->bind) !== false) {
                if (preg_match("/^(" . implode("|", array("select", "describe", "pragma")) . ") /i", $this->sql)) {
                    if ($single === false) {
                        return $pdostmt->fetchAll(\PDO::FETCH_ASSOC);
                    } elseif ($single === true) {
                        return $pdostmt->fetch(\PDO::FETCH_ASSOC);
                    }
                } elseif (preg_match("/^(insert) /i", $this->sql)) {
                    $last = \PDO::lastInsertId();
                    return $last;
                } else {
                    return true;
                }
            }
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
            echo $e->getMessage();
            return null;
        }
    }

    /*
	 *
	 * @param $table
	 * @param $where
	 * @param $bind
	 * $fields
	 */
    public function select(
        $table,
        $where = null,
        $limit = null,
        $order = null,
        $bind = "",
        $fields = "*",
        $activity = false
    ) {
        if (is_array($fields)) {
            $fields = implode(',', $fields);
        }
        $sql = "SELECT " . $fields . " FROM " . $table;
        if (!empty($where)) {
            $sql .= " WHERE " . $where;
        }
        if (!empty($where) && $activity == true) {
            $sql .= " AND activity=1";
        }
        if (empty($where) && $activity == true) {
            $sql .= " WHERE activity=1";
        }
        if (!empty($order)) {
            $sql .= " ORDER BY " . $order[0] . " " . $order[1];
        }
        if (!empty($limit)) {
            $sql .= " LIMIT " . $limit[0] . ", " . $limit[1];
        }
        $sql .= ";";
        $data = $this->run($sql, $bind);

        if ($data === false || $data === null || $data === array() || $data === '' || $data === 0) {
            return null;
        } else {
            return $data;
        }
    }

    /*
	 *
	 * @param $errorCallbackFunction
	 * @param $errorMsgFormat
	 * Variable functions for won't work with language constructs such as echo and print, so these are replaced with print_r.
	 *
	 */
    public function setErrorCallbackFunction($errorCallbackFunction, $errorMsgFormat = "html")
    {
        if (in_array(strtolower($errorCallbackFunction), array("echo", "print"))) {
            $errorCallbackFunction = "print_r";
        }
        if (function_exists($errorCallbackFunction)) {
            $this->errorCallbackFunction = $errorCallbackFunction;
            if (!in_array(strtolower($errorMsgFormat), array("html", "text"))) {
                $errorMsgFormat = "html";
            }
            $this->errorMsgFormat = $errorMsgFormat;
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

    /*
	 *
	 * @param $table
	 * @param $pk
	 */
    public function search($table, $field, $value)
    {
        $sql = "SELECT * FROM " . $table . " WHERE " . $field . " = '" . $value . "';";
        $data = $this->run($sql);
        if ($data === false || $data === null || $data === array() || $data === '' || $data === 0) {
            return null;
        }
        return $data;
    }
}
