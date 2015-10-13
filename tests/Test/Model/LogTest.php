<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\Sys\Model\Log;

class LogTest extends ModelTestCase
{
    public function testFind()
    {
        $result = Log::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testInsert()
    {
        $faker = \Faker\Factory::create('pt_BR');
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
        $user_id = 1;
        $group_name = 'content';
        $group_id = 1;
        $action = 'add';
        $item_name = 'collection';
        $item_id = 1;
        $nonce = '1234';
        $result = Log::query($this->db, 'log', $user_id, $group_name, $group_id, $action, $item_name, $item_id, $nonce);
        $this->runResultInsertTests($result);
    }
}
