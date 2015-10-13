<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
<<<<<<< HEAD
use Maltz\Radar\Model\Estate;

class EstateTest extends ModelTestCase
{
    public function testFind()
    {
        $result = Estate::query($this->db, 'find');
    }

    public function testShow()
    {
        $id = 1;
        $result = Estate::query($this->db, 'show', $id);
    }

    public function testInsert()
    {
        $faker = \Faker\Factory::create();
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Estate::query($this->db, 'insert', $record);
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
        $result = Estate::query($this->db, 'update', $record);
    }
=======
use Maltz\Sys\Model\User;

class EstateTest extends ModelTestCase
{

>>>>>>> 581057e42a9309b414205b42da284398c82a35a0
}
