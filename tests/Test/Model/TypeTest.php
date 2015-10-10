<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Sys\Model\Type;

class TypeTest extends ModelTestCase
{
    public function testDisplay()
    {
        $result = Type::query($this->db, 'display');
    }

    public function testFind()
    {
        $result = Type::query($this->db, 'find');
    }

    public function testShow()
    {
        $id = 1;
        $result = Type::query($this->db, 'show', $id);
    }

    public function testInsert()
    {
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Type::query($this->db, 'insert', $record);
        $this->runResultInsertTests($result);
    }

    public function testUpdate()
    {
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Type::query($this->db, 'update', $record);
    }

    public function testDelete()
    {
        $id = 1;
        $result = Type::query($this->db, 'delete', $id);
    }
}
