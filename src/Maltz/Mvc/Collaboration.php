<?php

namespace Maltz\Mvc;

trait Collaboration
{
    public function enter($user_id, $item_id)
    {
        $sql = "INSERT INTO collaborations (user_id, item_name, item_id) VALUES (:user_id, :item_name, :item_id)";
        $result = $this->db->run($sql, array('user_id' => $user_id, 'item_name' => $this->slug, 'item_id' => $item_id));
        return $result;
    }

    public function leave($user_id, $item_id)
    {
        $sql = "DELETE collaborations WHERE user_id=:user_id AND item_name=:item_name AND item_id=:item_id";
        $result = $this->db->run($sql, array('user_id' => $user_id, 'item_name' => $this->slug, 'item_id' => $item_id));
        return $result;
    }

    public function isUserInTeam($user_id, $item_id)
    {
        $sql = "SELECT user_id FROM collaborations WHERE user_id=:user_id AND item_id=:item_id";
        $result = $this->db->run($sql, array('user_id' => $user_id, 'item_id' => $item_id));
        return $result->isSuccesful();
    }

    public function getTeam($item_id)
    {
        $sql = "SELECT FROM user t1 
            JOIN collaborations t2 
            ON t1.id=t2.user_id
            WHERE item_name=:item_name
            AND item_id=:item_id";
        $result = $this->db->run($sql, array('item_name' => $this->slug, 'item_id' => $item_id));
        return $result;
    }
}
