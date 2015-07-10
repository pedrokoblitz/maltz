<?php

namespace Maltz\Mvc;

class Query
{

    /*
	 *
	 */
	public function __construct(DB $db, $action = null, array $params = null)
	{
		if ($action && !is_string($action)) {
			throw new \Exception("Error Processing Request", 1);			
		}

		$this->db = $db;
		$this->action = $action;
		$this->params = $params;
	}

    /*
	 *
	 */
	public function __set($key, $value)
	{
		if (is_string($key)) {
			switch ($key) {
				case 'action':
					$this->action = is_string($value) ? $value : null;
					break;
				case 'params':
					$this->params = is_array($value) ? $value : null;
					break;
			}
		}
	}

    /*
	 *
	 */
	public function __get($key)
	{
		return is_string($key) && in_array($key, array('db', 'action', 'params')) && isset($this->$key) ? $this->key : null;
	}
}