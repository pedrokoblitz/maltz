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
        $data = $this->db->run("INSERT INTO tokens (user_id, token, type) VALUES (?,MD5(CONCAT(RAND(), NOW())),?)", array('user_id'=> $user_id, 'token' => $token, 'type' => $type));
        return $token;
    }

    public function validate($token, $type)
    {
        $data = $this->db->run("SELECT token,user_id FROM tokens WHERE type=:type AND token=:token", array('type' => $type, 'token' => $token));
        $record = $data->getFirst();
        if ($record->get('token') === $token) {
            $user = $this->db->run("SELECT * FROM users WHERE id=:id", array('id' => $record->get('user_id')));
            return $user->getFirst();
        }
        return false;
    }
}
