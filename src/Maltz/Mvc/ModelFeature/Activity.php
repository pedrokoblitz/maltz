<?php

namespace Maltz\Mvc\ModelFeature;

trait Activity
{
    public function delete($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer", 001);
        }
        return $this->setActivity($id, 0);
    }

    public function deactivate($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 002);
        }
        return $this->setActivity($id, 1);
    }

    public function activate($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 003);
        }
        return $this->setActivity($id, 2);
    }

    public function promote($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 004);
        }
        $res = $this->getActivity($id);
        $activity = $res->getFirstRecord()->get('activity');
        $activity++;
        return $this->setActivity($id, $activity);
    }

    public function demote($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 005);
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
        if (!is_int($id) || !is_int($activity)) {
            throw new \Exception("Id must be integer.", 006);
        }
        $sql = "UPDATE $this->table SET activity=:activity WHERE id=:id";
        return $this->db->run($sql, array('id' => $id, 'activity' => $activity));
    }

    public function getActivity($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 007);
        }
        $sql = "SELECT activity FROM $this->table WHERE id=:id";
        return $this->db->run($sql, array('id' => $id));
    }
}
