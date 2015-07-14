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
     *
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
            if (!is_array($val)) {
                $bind[$key] = stripslashes($val);
            }
        }

        return $bind;
    }

    /*
	 *
	 */
    public function run($sql, $bind = "")
    {
        //var_dump($sql);

        $this->sql = trim($sql);
        $this->bind = $this->cleanup($bind);

        try {
            
            $pdostmt = $this->prepare($this->sql);
            if ($pdostmt->execute($this->bind) !== false) {

                if (preg_match("/^(select)/i", $this->sql)) {
                    $data = $pdostmt->fetchAll(\PDO::FETCH_ASSOC);
                    
                    if (empty($data)) {
                        return new Result(array('success' => false, 'message' => DbMessage::NOT_FOUND));
                    }

                    $results = array();
                    foreach ($data as $value) {
                        $results[] = new Record($value);
                    }
                    return new Result(array('records' => $results, 'success' => true, 'message' => DbMessage::SELECTED));

                } elseif (preg_match("/^(select found_rows)/i", $this->sql)) {
                    $data = $pdostmt->fetch(\PDO::FETCH_COLUMN);
                    return new Result(array('count' => $data, 'success' => true, 'message' => DbMessage::COUNTED));

                } elseif (preg_match("/^(count)/i", $this->sql)) {
                    $data = $pdostmt->fetch(\PDO::FETCH_COLUMN);
                    return new Result(array('count' => $data, 'success' => true, 'message' => DbMessage::COUNTED));
                
                } elseif (preg_match("/^(insert)/i", $this->sql)) {
                    $last = \PDO::lastInsertId();
                    return new Result(array('last_insert_id' => $last, 'success' => true, 'message' => DbMessage::INSERTED));
                
                } elseif (preg_match("/^(update)/i", $this->sql)) {
                    return new Result(array('success' => true, 'message' => DbMessage::UPDATED));
                
                } elseif (preg_match("/^(delete)/i", $this->sql)) {
                    return new Result(array('success' => true, 'message' => DbMessage::DELETED));
                }
            }
            return new Result(array('success' => false, 'message' => DbMessage::QUERY_FAIL));

        } catch (\PDOException $e) {
            return new Result(array('success' => false, 'message' => $e->getMessage()));
        }
    }
}
