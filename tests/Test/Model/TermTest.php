<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
<<<<<<< HEAD
use Maltz\Content\Model\Term;

class TermTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create();
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Term::query($this->db, 'insert', $record);
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
        $result = Term::query($this->db, 'update', $record);
    }

    public function testShow()
    {
        $id = 1;
        $result = Term::query($this->db, 'show', $id);
    }

    public function testFind()
    {
        $result = Term::query($this->db, 'find');
    }

    public function testDisplay()
    {
        $result = Term::query($this->db, 'display');
    }

    public function testFindByType()
    {
        $type = '';
        $result = Term::query($this->db, 'findByType', $type);
    }
=======
use Maltz\Sys\Model\User;

class TermTest extends ModelTestCase
{

>>>>>>> 581057e42a9309b414205b42da284398c82a35a0
}
