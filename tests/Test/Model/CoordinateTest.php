<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\GeoLocation\Model\Coordinate;

class CoordinateTest extends ModelTestCase
{
    public function setUp()
    {

    }

    public function tearDown()
    {
        
    }

    public function testFind()
    {
        $result = Coordinate::query($this->db, 'find');
    }

    public function testShow()
    {
        $id = 1;
        $result = Coordinate::query($this->db, 'show', $id);
    }

    public function testInsert()
    {
        $faker = \Faker\Factory::create();
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Coordinate::query($this->db, 'insert', $record);
        $this->runResultInsertTests($result);
    }

}
