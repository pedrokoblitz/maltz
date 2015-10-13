<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
<<<<<<< HEAD
use Maltz\GeoLocation\Model\Place;

class PlaceTest extends ModelTestCase
{
    public function testFind()
    {
        $result = Place::query($this->db, 'find');
    }

    public function testShow()
    {
        $id = 1;
        $result = Place::query($this->db, 'show', $id);
    }

    public function testInsert()
    {
        $faker = \Faker\Factory::create();
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
        $faker = \Faker\Factory::create();
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Place::query($this->db, 'update', $record);
    }
=======
use Maltz\Sys\Model\User;

class PlaceTest extends ModelTestCase
{

>>>>>>> 581057e42a9309b414205b42da284398c82a35a0
}
