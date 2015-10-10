<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Content\Model\Resource;

class ResourceTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create();
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Resource::query($this->db, 'insert', $record);
        $this->runResultInsertTests($result);
    }

    public function testDisplay()
    {
        $result = Resource::query($this->db, 'display');
    }

    public function testFind()
    {
        $result = Resource::query($this->db, 'find');
    }

    public function testFindByType()
    {
        $type = '';
        $result = Resource::query($this->db, 'findByType', $type);
    }

    public function testShow()
    {
        $id = 1;
        $result = Resource::query($this->db, 'show', $id);
    }
}
