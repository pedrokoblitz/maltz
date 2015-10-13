<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
<<<<<<< HEAD
use Maltz\SiteBuilding\Model\Block;

class BlockTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create();
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Block::query($this->db, 'insert', $record);
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
        $result = Block::query($this->db, 'update', $record);
    }

    public function testDelete()
    {
        $result = Block::query($this->db, 'delete');
    }

    public function testDisplay()
    {
        $result = Block::query($this->db, 'display');
    }

    public function testFind()
    {
        $result = Block::query($this->db, 'find');
    }

    public function testShow()
    {
        $id = 1;
        $result = Block::query($this->db, 'show', $id);
    }
=======
use Maltz\Sys\Model\User;

class BlockTest extends ModelTestCase
{

>>>>>>> 581057e42a9309b414205b42da284398c82a35a0
}
