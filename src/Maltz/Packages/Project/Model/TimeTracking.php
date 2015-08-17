<?php

namespace Maltz\Package\Project\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;

class TimeTracking extends Model
{
    public function __construct(DB $db)
    {
        parent::__construct($db, 'time_tracking', 'ticket_time_tracking', array('id' => 'int'));
    }

    protected function getCurrentId($user_id)
    {
        if (!(int) $user_id) {
            throw new \Exception("User_id must be integer.", 002);
        }

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

    public function start($ticket_id, $user_id)
    {
        if (!(int) $ticket_id || !(int) $user_id ) {
            throw new \Exception("Error Processing Request", 001);
        }

        if ($this->getCurrentId($user_id)->isSuccessful()) {
            $this->stop($user_id);
        }

        $sql = "INSERT INTO ticket_time_tracking ticket_id, (start) VALUES (:ticket_id, NOW())";
        return $this->db->run($sql, array('ticket_id' => $ticket_id));
    }

    public function stop($user_id)
    {
        if (!(int) $user_id) {
            throw new \Exception("User_id must be integer.", 003);
        }

        $currentId = $this->getCurrentId($user_id);

        if ($currentId->isSuccessful()) {
            $id = $currentId->getFirstRecord()->get('id');
            $sql = "UPDATE ticket_time_tracking SET stop=NOW() WHERE id=:id";
            return $this->db->run($sql, array('id' => $id));
        }

        throw new \Exception("Nothing to stop." , 004);
    }
}
