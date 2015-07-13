<?php

namespace Maltz\Sys\Model;

use Maltz\Mvc\Model;
use Maltz\Service\Pagination;

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
