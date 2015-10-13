<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\Project\Model\TimeTracking;

class TimeTrackingTest extends ModelTestCase
{
    public function testGetCurrentId()
    {
        $userId = 1;
        $result = TimeTracking::query($this->db, 'getCurrentId', $userId);
        $this->runResultSelectTests($result);
    }

    public function testStart()
    {
        $id = 1;
        $result = TimeTracking::query($this->db, 'start', $id);
        $this->runResultUpdateTests($result);
    }

    public function testStop()
    {
        $id = 1;
        $result = TimeTracking::query($this->db, 'stop', $id);
        $this->runResultUpdateTests($result);
    }
}
