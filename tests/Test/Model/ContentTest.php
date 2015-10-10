<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Content\Model\Content;

class ContentTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create();
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Content::query($this->db, 'insert', $record);
        $this->runResultInsertTests($result);
    }

    public function testUpdate()
    {
        $faker = \Faker\Factory::create();
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Content::query($this->db, 'update', $record);
    }

    public function testShow()
    {
        $id = 1;
        $result = Content::query($this->db, 'show', $id);
    }

    public function testFind()
    {
        $result = Content::query($this->db, 'find');
    }

    public function testFindByType()
    {
        $type = '';
        $result = Content::query($this->db, 'findByType', $type);
    }

    public function testSetAsDraft()
    {
        $id = 1;
        $result = Content::query($this->db, 'setAsDraft', $id);
    }

    public function testSetAsPending()
    {
        $id = 1;
        $result = Content::query($this->db, 'setAsPending', $id);
    }

    public function testPublish()
    {
        $id = 1;
        $result = Content::query($this->db, 'publish', $id);
    }
}
