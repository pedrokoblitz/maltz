<?php

namespace Maltz\Mvc;

trait Activity
{
    public function delete($id)
    {
        if (!(int) $id) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $this->setActivity($id, 0);
    }

    public function deactivate($id)
    {
        if (!(int) $id) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $this->setActivity($id, 1);
    }

    public function activate($id)
    {
        if (!(int) $id) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $this->setActivity($id, 2);
    }

    public function promote($id)
    {
        if (!(int) $id) {
            throw new \Exception("Error Processing Request", 1);
        }
        $res = $this->getActivity($id);
        $activity = $res->getFirstRecord()->get('activity');
        $activity++;
        return $this->setActivity($id, $activity);
    }

    public function demote($id)
    {
        if (!(int) $id) {
            throw new \Exception("Error Processing Request", 1);
        }
        $res = $this->getActivity($id);
        $activity = $res->getFirstRecord()->get('activity');
        if ($activity > 0) {
            $activity = $activity - 1;
            return $this->setActivity($id, $activity);
        }
    }

    public function setActivity($id, $activity)
    {
        if (!(int) $id || !(int) $activity) {
            throw new \Exception("Error Processing Request", 1);
        }
        $sql = "UPDATE $this->table SET activity=:activity WHERE id=:id";
        return $this->db->run($sql, array('id' => $id, 'activity' => $activity));
    }

    public function getActivity($id)
    {
        if (!(int) $id) {
            throw new \Exception("Error Processing Request", 1);
        }
        $sql = "SELECT activity FROM $this->table WHERE id=:id";
        return $this->db->run($sql, array('id' => $id));
    }
}
