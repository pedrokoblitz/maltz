<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\Sys\Model\Type;

class TypeTest extends ModelTestCase
{
    public function testDisplay()
    {
        $result = Type::query($this->db, 'display');
        $this->runResultSelectTests($result);
    }

    public function testFind()
    {
        $result = Type::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testShow()
    {
        $id = 1;
        $result = Type::query($this->db, 'show', $id);
        $this->runResultSelectTests($result);
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
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Type::query($this->db, 'update', $record);
        $this->runResultUpdateTests($result);
    }

    public function testDelete()
    {
        $id = 1;
        $result = Type::query($this->db, 'delete', $id);
        $this->runResultUpdateTests($result);
    }
}
