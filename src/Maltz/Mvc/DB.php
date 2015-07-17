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

    private $settings;
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
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        );

        try {
            parent::__construct($dsn, $user, $passwd, $options);
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
        }

        $this->settings['result.keys']['success'] = 'success';
        $this->settings['result.keys']['message'] = 'message';
        $this->settings['result.keys']['records'] = 'records';
        $this->settings['result.keys']['id.list'] = 'id.list';
        $this->settings['result.keys']['last.insert.id'] = 'last.insert.id';
        $this->settings['result.keys']['count'] = 'count';
        $this->settings['return.value'] = new Result(array('success' => false));
    }

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

    public function run($sql, $bind = "", array $settings = array())
    {
        //var_dump($sql);
        $settings = array_merge($settings, $this->settings);

        $this->sql = trim($sql);
        $this->bind = $this->cleanup($bind);

        try {
            $pdostmt = $this->prepare($this->sql);
            if ($pdostmt->execute($this->bind) !== false) {
                if (preg_match("/^(select)/i", $this->sql)) {
                    $data = $pdostmt->fetchAll(\PDO::FETCH_ASSOC);
                    
                    if (empty($data)) {
                        $result = $settings['return.value'];
                        $result->set('message', DbMessage::NOT_FOUND);
                        return $result;
                    }

                    $records = array();
                    $ids = array();
                    foreach ($data as $value) {
                        if (isset($value['id'])) {
                            $ids[] = $value['id'];
                        }
                        $records[] = new Record($value);
                    }
                    $result = $settings['return.value'];
                    $result->set('success', true);
                    $result->set('records', $records);
                    $result->set('message', DbMessage::SELECTED);
                    !empty($ids) ? $result->set('id.list', $ids) : false;
                    return $result;

                } elseif (preg_match("/^(select found_rows)/i", $this->sql)) {
                    $data = $pdostmt->fetch(\PDO::FETCH_COLUMN);
                    $result = $settings['return.value'];
                    $result->set('success', true);
                    $result->set('count', $data);
                    $result->set('message', DbMessage::COUNTED);
                    return $result;

                } elseif (preg_match("/^(count)/i", $this->sql)) {
                    $data = $pdostmt->fetch(\PDO::FETCH_COLUMN);
                    $result = $settings['return.value'];
                    $result->set('success', true);
                    $result->set('count', $data);
                    $result->set('message', DbMessage::COUNTED);
                    return $result;
                
                } elseif (preg_match("/^(insert)/i", $this->sql)) {
                    $last = \PDO::lastInsertId();
                    $result = $settings['return.value'];
                    $result->set('success', true);
                    $result->set('last.insert.id', $last);
                    $result->set('message', DbMessage::INSERTED);
                    return $result;
                
                } elseif (preg_match("/^(update)/i", $this->sql)) {
                    $result = $settings['return.value'];
                    $result->set('success', true);
                    $result->set('message', DbMessage::UPDATED);
                    return $result;
                
                } elseif (preg_match("/^(delete)/i", $this->sql)) {
                    $result = $settings['return.value'];
                    $result->set('success', true);
                    $result->set('message', DbMessage::DELETED);
                    return $result;
                }
            }
            return new Result(array('success' => false, 'message' => DbMessage::QUERY_FAIL));

        } catch (\PDOException $e) {
            $result = $settings['return.value'];
            $result->set('message', $e->getMessage());
            return $result;
        }
    }
}
