<?php

namespace Maltz\Project\Model;

class TimeTracking extends Model
{
    public function __construct($db)
    {
        parent::__construct($db, 'time_tracking', 'ticket_time_tracking', array('id' => 'int'));
    }

    public function start($ticket_id)
    {
        $sql = "INSERT INTO ticket_time_tracking ticket_id, (start) VALUES (:ticket_id, NOW())";
        return $this->db->run($sql, array('ticket_id' => $ticket_id));
    }

    public function getCurrentId($user_id)
    {
        $sql = "SELECT t1.ticket_id 
        FROM ticket_time_tracking t1
            JOIN tickets t2
                ON t1.ticket_id=t2.id
            JOIN users t3
                ON t2.user_id=t3.id
            WHERE stop=NULL
            AND t2.user_id=:user_id";
        return $this->db->run($sql, array('user_id' => $user_id));
    }

    public function stop($user_id)
    {
        $id = $this->getCurrentId($user_id)->getFirstRecord()->get('id');
        $sql = "UPDATE ticket_time_tracking SET stop=NOW() WHERE id=:id";
        return $this->db->run($sql, array('id' => $id));
    }
}
