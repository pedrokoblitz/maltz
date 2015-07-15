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

    public function getCurrentId()
    {
        $sql = "SELECT ticket_id FROM ticket_time_tracking WHERE stop=NULL";
        return $this->db->run($sql);
    }

    public function stop()
    {
        $id = $this->getCurrentId()->getFirstRecord()->get('id');
        $sql = "UPDATE ticket_time_tracking SET stop=NOW() WHERE id=:id";
        return $this->db->run($sql, array('id' => $id));
    }
}
