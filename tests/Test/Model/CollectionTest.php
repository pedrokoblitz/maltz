<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
<<<<<<< HEAD
use Maltz\Content\Model\Collection;

class CollectionTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create();
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Collection::query($this->db, 'insert', $record);
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
        $result = Collection::query($this->db, 'update', $record);
    }

    public function testDisplay()
    {
        $result = Collection::query($this->db, 'display');
    }

    public function testFind()
    {
        $result = Collection::query($this->db, 'find');
    }

    public function testFindByType()
    {
        $result = Collection::query($this->db, 'findByType');
    }

    public function testShow()
    {
        $id = 1;
        $result = Collection::query($this->db, 'show', $id);
    }
=======
use Maltz\Sys\Model\User;

class CollectionTest extends ModelTestCase
{

>>>>>>> 581057e42a9309b414205b42da284398c82a35a0
}
