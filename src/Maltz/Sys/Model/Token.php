<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;
use Maltz\Service\Pagination;

class Token extends Model
{

    public function __construct(DB $db)
    {
        $rules = array();
        parent::__construct($db, 'token', 'tokens', $rules);
    }

    public function generate($user_id, $type)
    {
        if (!is_int($user_id) || !is_string($type)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $this->db->run("DELETE FROM tokens WHERE type=:type AND user_id=:user_id", array('type' => $type, 'user_id' => $user_id));
        $data = $this->db->run("INSERT INTO tokens (user_id, token, type) VALUES (?,MD5(CONCAT(RAND(), NOW())),?)", array('user_id'=> $user_id, 'token' => $token, 'type' => $type));
        return $token;
    }

    public function validate($token, $type)
    {
        if (!is_string($token) || !is_string($type)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $data = $this->db->run("SELECT token,user_id FROM tokens WHERE type=:type AND token=:token", array('type' => $type, 'token' => $token));
        $record = $data->getFirst();
        if ($record->get('token') === $token) {
            $sql = "UPDATE tokens SET used=NOW() WHERE type=:type AND token=:token";
            $this->db->run($sql, array('type' => $type, 'token' => $token));
            $sql = "SELECT * FROM users WHERE id=:id";
            $user = $this->db->run($sql, array('id' => $record->get('user_id')));
            $record = $user->getFirstRecord();
            return $record;
        }
        return false;
    }
}
