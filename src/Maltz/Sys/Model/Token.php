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
        if (!(int) $user_id || !is_string($type)) {
            throw new \Exception("User_id must be integer and type must be string.", 001);
        }
        
        $sql = "DELETE FROM tokens WHERE type=:type AND user_id=:user_id";
        $delete = $this->db->run($sql, array('type' => $type, 'user_id' => $user_id));

        $sql = "INSERT INTO tokens (user_id, token, type) VALUES (:user_id, UUID(), :type)";
        $insert = $this->db->run($sql, array('user_id'=> $user_id, 'type' => $type));
        
        if (!$insert->isSuccessful()) {
            throw new \Exception("Unable to insert token", 001);
        }

        $sql = "SELECT token 
            FROM tokens 
            WHERE id=:id";
        $token = $this->db->run($sql, array('id' => $insert->getLastInsertId()));
        return $token->getFirstRecord()->get('token');
    }

    public function validate($token, $type)
    {
        if (!is_string($token) || !is_string($type)) {
            throw new \Exception("Token and type must be strings", 002);
        }
        
        $sql = "SELECT token,user_id 
            FROM tokens 
            WHERE type=:type 
            AND token=:token";
        $data = $this->db->run($sql, array('type' => $type, 'token' => $token));
        return $data->getFirstRecord()->get('token');
    }
}
