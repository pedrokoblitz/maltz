<?php 

namespace Maltz\Mvc;

trait Activity
{


    public function delete($id)
    {
        $setActivityQuery = "UPDATE $this->table SET activity=:activity WHERE id=:id";
        return $this->db->run($setActivityQuery, array('activity' => 0, 'id' => $id));
    }

    public function deactivate($id)
    {
        $setActivityQuery = "UPDATE $this->table SET activity=:activity WHERE id=:id";
        return $this->db->run($setActivityQuery, array('activity' => 1, 'id' => $id));
    }

    public function activate($id)
    {
        $setActivityQuery = "UPDATE $this->table SET activity=:activity WHERE id=:id";
        return $this->db->run($setActivityQuery, array('activity' => 2, 'id' => $id));
    }

    public function setAsDraft($id)
    {
        $setActivityQuery = "UPDATE $this->table SET activity=:activity WHERE id=:id";
        return $this->db->run($setActivityQuery, array('activity' => 3, 'id' => $id));
    }

    public function setAsPending($id)
    {
        $setActivityQuery = "UPDATE $this->table SET activity=:activity WHERE id=:id";
        return $this->db->run($setActivityQuery, array('activity' => 4, 'id' => $id));
    }

    public function pulish($id)
    {
        $setActivityQuery = "UPDATE $this->table SET activity=:activity WHERE id=:id";
        return $this->db->run($setActivityQuery, array('activity' => 5, 'id' => $id));
    }

    public function promote($id)
    {
        $getActivityQuery = "SELECT activity FROM $this->table WHERE id=:id";
        $res = $this->db->run($getActivityQuery, array('id' => $id));
        $activity = $res->getFirstRecord()->get('activity');
        $activity++;
        return $this->db->run($setActivityQuery, array('activity' => $activity, 'id' => $id));
    }

    public function demote($id)
    {
        $getActivityQuery = "SELECT activity FROM $this->table WHERE id=:id";
        $res = $this->db->run($getActivityQuery, array('id' => $id));
        $activity = $res->getFirstRecord()->get('activity');
        if ($activity > 0) {
            $activity = $activity - 1;
            return $this->db->run($setActivityQuery, array('activity' => $activity, 'id' => $id));
        }
    }

    public function getActivity($id)
    {
        $getActivityQuery = "SELECT activity FROM $this->table WHERE id=:id";
        return $this->db->run($getActivityQuery, array('id' => $id));
    }
}