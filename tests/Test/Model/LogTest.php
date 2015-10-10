<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Sys\Model\Log;

class LogTest extends ModelTestCase
{
    public function testFind()
    {
        $result = Log::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testInsert()
    {
        $faker = \Faker\Factory::create();
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Log::query($this->db, 'insert', $record);
        $this->runResultInsertTests($result);
    }

    public function testLog()
    {
        $result = Log::query($this->db, 'log');
        $this->runResultInsertTests($result);
    }
}
