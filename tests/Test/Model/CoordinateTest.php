<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\GeoLocation\Model\Coordinate;

class CoordinateTest extends ModelTestCase
{
    public function testFind()
    {
        $result = Coordinate::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testShow()
    {
        $id = 1;
        $result = Coordinate::query($this->db, 'show', $id);
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
        $result = Coordinate::query($this->db, 'insert', $record);
        $this->runResultInsertTests($result);
    }
}
