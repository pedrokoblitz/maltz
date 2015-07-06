<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;

class Token extends Model
{

    public function __construct($db)
    {
        parent::__construct($db, 'token', 'tokens', 'token_id');
    }

    public function generate($user_id, $type)
    {
        $this->db->run("DELETE FROM tokens WHERE type=:type AND user_id=:user_id", array('type' => $type, 'user_id' => $user_id));
        $token = md5(microtime() . $type . $user_id);
        $data = $this->db->insert($this->table, array('user_id'=> $user_id, 'token' => $token, 'type' => $type));
        $this->set('meta.insert', $data);
        return $token;
    }

    public function validate($token, $type)
    {
        $data = $this->db->run("SELECT * FROM tokens WHERE type=:type AND token=:token", array('type' => $type, 'token' => $token));
        $this->set('data.record', $data);
        if ($data[0]['token'] === $token) {
            $user = $this->db->run("SELECT * FROM users WHERE id=:uid", array('uid' => $data[0]['user_id']));
            return $user[0];
        }
        return false;
    }
}
