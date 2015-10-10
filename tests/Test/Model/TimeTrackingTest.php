<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Project\Model\TimeTracking;

class TimeTrackingTest extends ModelTestCase
{
    public function testGetCurrentId()
    {
        $result = TimeTracking::query($this->db, 'getCurrentId');
    }

    public function testStart()
    {
        $id = 1;
        $result = TimeTracking::query($this->db, 'start', $id);
    }

    public function testStop()
    {
        $id = 1;
        $result = TimeTracking::query($this->db, 'stop', $id);
    }
}
