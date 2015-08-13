<?php

namespace Maltz\Mvc;

trait Ownership
{
    public function own($user_id, $item_id)
    {
        $sql = "INSERT INTO ownership (user_id, item_name, item_id) VALUES (:user_id, :item_name, :item_id)";
        $result = $this->db->run($sql, array('user_id' => $user_id, 'item_name' => $this->slug, 'item_id' => $item_id));
        return $result;
    }

    public function change($user_id, $item_id)
    {
        $sql = "UPDATE ownership SET user_id=:user_id) WHERE item_name=:item_name AND item_id=:item_id";
        $result = $this->db->run($sql, array('user_id' => $user_id, 'item_name' => $this->slug, 'item_id' => $item_id));
        return $result;
    }

    public function isOwner($user_id, $item_id)
    {
        $sql = "SELECT user_id FROM ownership WHERE user_id=:user_id AND item_id=:item_id";
        $result = $this->db->run($sql, array('user_id' => $user_id, 'item_id' => $item_id));
        return $result->isSuccesful();
    }

    public function getOwner($item_id)
    {
        $sql = "SELECT user_id, username, email, first_name, last_name FROM user t1 
            JOIN ownership t2 
            ON t1.id=t2.user_id
            WHERE item_name=:item_name
            AND item_id=:item_id";
        $result = $this->db->run($sql, array('item_name' => $this->slug, 'item_id' => $item_id));
        return $result;
    }
}
