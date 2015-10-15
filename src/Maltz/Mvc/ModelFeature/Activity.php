<?php

namespace Maltz\Mvc\ModelFeature;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait Activity
{
    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer", 001);
        }
        return $this->setActivity($id, 0);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deactivate($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 002);
        }
        return $this->setActivity($id, 1);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function activate($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 003);
        }
        return $this->setActivity($id, 2);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
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

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
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

    /**
     * /
     * @param [type] $id       [description]
     * @param [type] $activity [description]
     */
    public function setActivity($id, $activity)
    {
        if (!is_int($id) || !is_int($activity)) {
            throw new \Exception("Id must be integer.", 006);
        }
        $sql = "UPDATE $this->table SET activity=:activity WHERE id=:id";
        return $this->db->run($sql, array('id' => $id, 'activity' => $activity));
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getActivity($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Id must be integer.", 007);
        }
        $sql = "SELECT activity FROM $this->table WHERE id=:id";
        return $this->db->run($sql, array('id' => $id));
    }
}
