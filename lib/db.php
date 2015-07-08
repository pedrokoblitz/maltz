<?php

/**
 * Adaptador do PDO
 * 
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author      Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Meu CMS ainda não tem nome
 *
 * @version    0.1 alpha
 */


class DB extends PDO {

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
        public function __construct($dsn, $user="", $passwd="") {
                $options = array(
                        PDO::ATTR_PERSISTENT => true,
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                );

                try {
                        parent::__construct($dsn, $user, $passwd, $options);
                } catch (PDOException $e) {
                        $this->error = $e->getMessage();
                }
        }

	/*
	* 
	*
	*
	*
	*
	*/
        private function debug() {
                if(!empty($this->errorCallbackFunction)) {
                        $error = array("Error" => $this->error);
                        if(!empty($this->sql))
                                $error["SQL Statement"] = $this->sql;
                        if(!empty($this->bind))
                                $error["Bind Parameters"] = trim(print_r($this->bind, true));

                        $backtrace = debug_backtrace();
                        if(!empty($backtrace)) {
                                foreach($backtrace as $info) {
                                        if($info["file"] != __FILE__)
                                                $error["Backtrace"] = $info["file"] . " at line " . $info["line"];      
                                }              
                        }

                        $msg = "";
                        if($this->errorMsgFormat == "html") {
                                if(!empty($error["Bind Parameters"]))
                                        $error["Bind Parameters"] = "<pre>" . $error["Bind Parameters"] . "</pre>";
                                $css = trim(file_get_contents(dirname(__FILE__) . "/error.css"));
                                $msg .= '<style type="text/css">' . "\n" . $css . "\n</style>";
                                $msg .= "\n" . '<div class="db-error">' . "\n\t<h3>SQL Error</h3>";
                                foreach($error as $key => $val)
                                        $msg .= "\n\t<label>" . $key . ":</label>" . $val;
                                $msg .= "\n\t</div>\n</div>";
                        }
                        elseif($this->errorMsgFormat == "text") {
                                $msg .= "SQL Error\n" . str_repeat("-", 50);
                                foreach($error as $key => $val)
                                        $msg .= "\n\n$key:\n$val";
                        }

                        $func = $this->errorCallbackFunction;
                        $func($msg);
                }
        }

	/*
	* 
	* @param $table
	* @param $where
	* @param $bind
	*
	*/
        public function delete($table, $where, $bind="") {
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
        private function filter($table, $info) {
                $driver = $this->getAttribute(PDO::ATTR_DRIVER_NAME);
                if($driver == 'sqlite') {
                        $sql = "PRAGMA table_info('" . $table . "');";
                        $key = "name";
                }
                elseif($driver == 'mysql') {
                        $sql = "DESCRIBE " . $table . ";";
                        $key = "Field";
                }
                else {  
                        $sql = "SELECT column_name FROM information_schema.columns WHERE table_name = '" . $table . "';";
                        $key = "column_name";
                }      

                if(false !== ($list = $this->run($sql))) {
                        $fields = array();
                        foreach($list as $record)
                                $fields[] = $record[$key];
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
        private function cleanup($bind) {
                if(!is_array($bind)) {
                        if(!empty($bind))
                                $bind = array($bind);
                        else
                                $bind = array();
                }
                foreach($bind as $key => $val) {
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
        public function insert($table, $info) {
                $fields = $this->filter($table, $info);
                $sql = "INSERT INTO " . $table . " (" . implode($fields, ", ") . ") VALUES (:" . implode($fields, ", :") . ");";
                $bind = array();
                foreach($fields as $field) {
                        $bind[":$field"] = $info[$field];
		}
                $dados = $this->run($sql, $bind);
		if ($dados === false || $dados === null || $dados === array() || $dados === '' || $dados === 0 )
		{
			return false;
		}
		return $dados;

        }

	/*
	* 
	*
	* @param $sql
	* @param $bind
	*
	*/
        public function run($sql, $bind="") {
//var_dump($sql);
                $this->sql = trim($sql);
                $this->bind = $this->cleanup($bind);
                $this->error = "";
//var_dump($this->sql);

                try {
                        $pdostmt = $this->prepare($this->sql);
                        if($pdostmt->execute($this->bind) !== false) {
                                if(preg_match("/^(" . implode("|", array("select", "describe", "pragma")) . ") /i", $this->sql)) {
                                        return $pdostmt->fetchAll(PDO::FETCH_ASSOC);
				}
								$last = PDO::lastInsertId();
                                return $last; 
                        }      
                } catch (PDOException $e) {
                        $this->error = $e->getMessage();        
                        $this->debug();
                        return false;
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
			$where, 
			$limit,
			$order, 
			$bind="", 
			$fields="*", 
			$ativo=false
		) {
                $sql = "SELECT " . $fields . " FROM " . $table;
                if (!empty($where)) {
                        $sql .= " WHERE " . $where;
					}
				if (!empty($where) && $ativo==true) {
		                $sql .= " AND ativo=1";
				}
				if (empty($where) && $ativo==true) {
		                $sql .= " WHERE ativo=1";
				}
                if (!empty($order)) {
                        $sql .= " ORDER BY " . $order[0] . " " . $order[1];
					}
                if (!empty($limit)) {
                        $sql .= " LIMIT " . $limit[0] . ", " . $limit[1];
					}
                $sql .= ";";
                $dados = $this->run($sql, $bind);

				if ($dados === false || $dados === null || $dados === array() || $dados === '' || $dados === 0 )
				{
					return false;
				} else {
					return $dados;
				}
        }


	/*
	* 
	* @param $errorCallbackFunction
	* @param $errorMsgFormat
	* Variable functions for won't work with language constructs such as echo and print, so these are replaced with print_r.
	*
	*/
        public function setErrorCallbackFunction($errorCallbackFunction, $errorMsgFormat="html") {
                if(in_array(strtolower($errorCallbackFunction), array("echo", "print"))) {
                        $errorCallbackFunction = "print_r";
		}
                if(function_exists($errorCallbackFunction)) {
                        $this->errorCallbackFunction = $errorCallbackFunction;  
                        if(!in_array(strtolower($errorMsgFormat), array("html", "text")))
                                $errorMsgFormat = "html";
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
        public function update($table, $info, $where, $bind="") {
                $fields = $this->filter($table, $info);
                $fieldSize = sizeof($fields);

                $sql = "UPDATE " . $table . " SET ";
                for($f = 0; $f < $fieldSize; ++$f) {
                        if($f > 0)
                                $sql .= ", ";
                        $sql .= $fields[$f] . "=:update_" . $fields[$f];
                }
                $sql .= " WHERE " . $where . ";";

                $bind = $this->cleanup($bind);
                foreach($fields as $field) {
                        $bind[":update_$field"] = $info[$field];
                }
		$dados = $this->run($sql, $bind);
		if ($dados === false || $dados === null || $dados === array() || $dados === '' || $dados === 0 )
		{
			return false;
		}
		return $dados;

        }

	/*
	* 
	* @param $table
	* @param $pk
	*/
	public function count($table)
	{
		$sql = "SELECT COUNT(*) FROM " . $table . ";";
   		$dados = $this->run($sql);
		if ($dados === false || $dados === null || $dados === array() || $dados === '' || $dados === 0 )
		{
			return false;
		}
		return $dados;

		
	}

	/*
	* 
	* @param $table
	* @param $pk
	*/
	public function search($table,$campo,$valor)
	{
		$sql = "SELECT * FROM " . $table . " WHERE " . $campo . " = '" . $valor . "';";
	    	$dados = $this->run($sql);
		if ($dados === false || $dados === null || $dados === array() || $dados === '' || $dados === 0 )
		{
			return false;
		}
		return $dados;
		
	}

}      

?>



