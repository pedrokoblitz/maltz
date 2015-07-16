<?php 

namespace Maltz\Mvc;

trait Activity
{

    public function delete($id)
    {
        return $this->setActivity($id, 0);
    }

    public function deactivate($id)
    {
        return $this->setActivity($id, 1);
    }

    public function activate($id)
    {
        return $this->setActivity($id, 2);
    }

    public function promote($id)
    {
        $res = $this->getActivity($id);
        $activity = $res->getFirstRecord()->get('activity');
        $activity++;
        return $this->setActivity($id, $activity);
    }

    public function demote($id)
    {
        $res = $this->getActivity($id);
        $activity = $res->getFirstRecord()->get('activity');
        if ($activity > 0) {
            $activity = $activity - 1;
            return $this->setActivity($id, $activity);
        }
    }

    public function setActivity($id, $activity)
    {
        $sql = "UPDATE $this->table SET activity=:activity WHERE id=:id";
        return $this->db->run($sql, array('id' => $id, 'activity' => $activity));
    }

    public function getActivity($id)
    {
        $sql = "SELECT activity FROM $this->table WHERE id=:id";
        return $this->db->run($sql, array('id' => $id));
    }
}