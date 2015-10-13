<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\GeoLocation\Model\Place;

class PlaceTest extends ModelTestCase
{
    public function testFind()
    {
        $result = Place::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testShow()
    {
        $id = 1;
        $result = Place::query($this->db, 'show', $id);
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
        $result = Place::query($this->db, 'insert', $record);
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
        $result = Place::query($this->db, 'update', $record);
        $this->runResultUpdateTests($result);
    }
}
