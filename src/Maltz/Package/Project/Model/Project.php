<?php

namespace Maltz\Package\Project\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\ModelFeature\Activity;
use Maltz\Service\Pagination;

class Project extends Model
{
    public function __construct(DB $db)
    {
        $rules = array(
            'title' => 'string',
            'description' => 'textarea',
            'activity' => 'int'
            );
        parent::__construct($db, 'project', 'projects', $rules);
    }

    public function insert(Record $record)
    {
        $sql = "INSERT INTO projects (title, description, activity) VALUES (:title, :description, :activity)";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    public function update(Record $record)
    {
        $sql = "UPDATE projects SET title=:title, description=:description, activity=:activity";
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    public function show($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 001);
        }

        $sql = "SELECT title, description, activity FROM projects WHEERE id=:id";
        $result = $this->db->run($sql, array('id' => $id));
        return $result;
    }

    public function find($pg = 1, $per_page = 12, $key = 'title', $order = 'asc')
    {
        if (!is_int($pg) || !is_int($per_page) || !is_string($key) || !is_string($order)) {
            throw new \Exception("Page and per_page must be integers, key and order must be strings.", 002);
        }

        $pagination = Pagination::paginate($pg, $per_page);
        $sql = "SELECT title, description, activity FROM projects
            ORDER BY $key $order
            LIMIT $pagination->offset, $pagination->limit
            WHERE activity > :activity";
        $result = $this->db->run($sql, array('activity' => 0));
        return $result;
    }

    public function getDevs($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer", 003);
        }

        $sql = "SELECT t1.id, t1.username, t1.name, t1.email
            FROM users t1
            JOIN tickets t2
                ON t1.id=t2.dev_id
            WHERE t2.project_id=:project_id";
        $result = $this->db->run($sql, array('project_id' => $id));
        return $result;
    }

    public function addUser($id, $user_id)
    {
        if (!is_int($id) || !is_int($user_id)) {
            throw new \Exception("Id and user_id must be integers.", 004);
        }

        $sql = "INSERT INTO attachments (group_name, group_id, item_name, item_id) VALUES (:group_name, :group_id, :item_name, :item_id)";
        $result = $this->db->run($sql, array('group_name' => 'project', 'group_id' => $id, 'item_name' => 'user', 'item_id' => $user_id));
        return $result;
    }

    public function removeUser($id, $user_id)
    {
        if (!is_int($id) || !is_int($user_id)) {
            throw new \Exception("Id and user_id must be integers.", 005);
        }

        $sql = "DELETE FROM attachments WHERE group_name=:group_name AND group_id=:group_id AND item_name=:item_name AND item_id=:item_id";
        $result = $this->db->run($sql, array('group_name' => 'project', 'group_id' => $id, 'item_name' => 'user', 'item_id' => $user_id));
        return $result;
    }

    public function getUsers($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 006);
        }

        $sql = "SELECT t1.id, t1.username, t1.name, t1.email
            FROM users t1
            JOIN attachments t2
                ON t1.id=t2.item_id
                AND t2.item_name=:item_name
            WHERE t2.group_id=:project_id
                AND t2.group_name=:group_name";
        $result = $this->db->run($sql, array('group_name' => 'project', 'group_id' => $id, 'item_name' => 'user'));
        return $result;
    }

    public function getTickets($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 007);
        }

        $sql = "SELECT t1.id, t2.id as user_id, t2.name, t2.email FROM tickets t1 
            JOIN users t2
                ON t1.dev_id=t2.id
            WHERE project_id=:project_id";
        $result = $this->db->run($sql, array('project_id' => $id));
        return $result;
    }

    public function getInvoices($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 008);
        }

        $sql = "SELECT (dev_id, user_id, hash, priority, description, activity, created, modified) FROM tickets WHERE project_id=:id";
        $result = $this->db->run($sql, array('id' => $id));
        return $result;
    }

    public function getBillableHours($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 009);
        }

        $sql = "SELECT
            SEC_TO_TIME(SUM(TIME_TO_SEC(timediff(t1.start, t1.stop)))) AS totalhours,
            t4.value as rate,
            totalhours*rate AS total,
            t3.title AS title -- add activity for proj report and proj.title for full report
              FROM ticket_time_tracking t1 
              JOIN tickets t2
                ON t1.ticket_id=t2.id
              JOIN projects t3
                ON t2.project_id=t3.id
              JOIN metadata t4
                ON t1.dev_id=t4.item_id
                AND t4.item_name=:user_item
                AND t4.key=:meta_key
            WHERE t2.project_id=:project_id -- (remove for total report)
                AND t2.activity = :activity";
        $result = $this->db->run($sql, array('activity' => 4, 'project_id' => $id, 'user_item' => 'user', 'meta_key' => 'hourly_rate'));
        return $result;
    }

    public function createReport($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 010);
        }

        $sql = "SELECT
            SEC_TO_TIME(SUM(TIME_TO_SEC(timediff(t1.start, t1.stop)))) AS totalhours,
            t4.value as rate,
            totalhours*rate AS total,
            t3.title AS title -- add activity for proj report and proj.title for full report
              FROM ticket_time_tracking t1 
              JOIN tickets t2
                ON t1.ticket_id=t2.id
              JOIN projects t3
                ON t2.project_id=t3.id
              JOIN metadata t4
                ON t1.dev_id=t4.item_id
                AND t4.item_name=:user_item
                AND t4.key=:meta_key
            WHERE t2.activity = :activity";
        $result = $this->db->run($sql, array('activity' => 4, 'user_item' => 'user', 'meta_key' => 'hourly_rate'));
        return $result;
    }

    public function createInvoice($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 011);
        }

        $record = $this->getBillableHours($id)->getFirstRecord();
        if (!$record instanceof Record) {
            throw new \Exception("Not a valid record." , 1);
        }
        $record->set('activity', 1);
        return Invoice::query($this->db, 'save', $record);
    }
}
