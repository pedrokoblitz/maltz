<?php

namespace Maltz\Utils;

class LogHelper
{
    private $log;

    public function __construct($db)
    {
        $this->log = new Log($db);
    }

    /*
	 * insere no banco
	 *
	 *
	 * @param
	 *
	 * return void
	 */
    private function save($data)
    {
        $this->log->insert('log', $data);
    }

    /*
	 * registrar o Log no banco de data
	 *
	 *
	 * @param $db
	 * @param $user
	 * @param $user_id
	 * @param $action
	 * @param $nameComponente
	 * @param $id
	 *
	 * return void
	 */
    public function write($user, $user_id, $action, $nameComponente, $id = null)
    {
        $data = array();
        $data['user'] = $user;
        $data['user_id'] = $user_id;
        $data['action'] = $action;
        $data['model'] = $nameComponente;
        $data['object_id'] = $id;
        $data['activity'] = 1;
        $this->save($data);
    }
}
