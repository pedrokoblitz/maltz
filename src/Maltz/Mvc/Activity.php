<?php 

namespace Maltz\Mvc\Model;

trait Activity
{
    const TRASH = 0;
    const INACTIVE = 1;
    const ACTIVE = 2;
    const DRAFT = 3;
    const PENDING = 4;
    const PUBLISHED = 5;

    protected $setActivityQuery = "UPDATE $this->table SET activity=:activity WHERE id=:id";
    protected $getActivityQuery = "SELECT activity FROM $this->table WHERE id=:id";

    public function delete($id)
    {
        return $this->db->run($setActivityQuery, array('activity' => self::TRASH, 'id' => $id));
    }

    public function deactivate($id)
    {
        return $this->db->run($setActivityQuery, array('activity' => self::INACTIVE, 'id' => $id));
    }

    public function activate($id)
    {
        return $this->db->run($setActivityQuery, array('activity' => self::ACTIVE, 'id' => $id));
    }

    public function setAsDraft($id)
    {
        return $this->db->run($setActivityQuery, array('activity' => self::DRAFT, 'id' => $id));
    }

    public function setAsPending($id)
    {
        return $this->db->run($setActivityQuery, array('activity' => self::PENDING, 'id' => $id));
    }

    public function pulish($id)
    {
        return $this->db->run($setActivityQuery, array('activity' => self::PUBLISHED, 'id' => $id));
    }

    public function promote($id)
    {
        $res = $this->db->run($getActivityQuery, array('id' => $id));
        $activity = $res->getFirstRecord()->get('activity');
        $activity++;
        return $this->db->run($setActivityQuery, array('activity' => $activity, 'id' => $id));
    }

    public function demote($id)
    {
        $res = $this->db->run($getActivityQuery, array('id' => $id));
        $activity = $res->getFirstRecord()->get('activity');
        if ($activity > 0) {
            $activity = $activity - 1;
            return $this->db->run($setActivityQuery, array('activity' => $activity, 'id' => $id));
        }
    }

    public function getActivity($id)
    {
        return $this->db->run($getActivityQuery, array('id' => $id));
    }
}