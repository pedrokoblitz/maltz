<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\Content\Model\Term;

class TermTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                'parent_id' => 0,
                'type_id' => 13,
                'activity' => 1,
                'user_id' => 1,
                'title' => $faker->sentence(),
                'language' => 'pt-br',
            )
        );
        $result = Term::query($this->db, 'insert', $record);
        $this->runResultInsertTests($result);
    }

    public function testUpdate()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                'id' => 1,
                'parent_id' => 0,
                'type_id' => 13,
                'activity' => 1,
                'user_id' => 1,
                'title' => $faker->sentence(),
                'language' => 'pt-br',
            )
        );
        $result = Term::query($this->db, 'update', $record);
        $this->runResultUpdateTests($result);
    }

    public function testShow()
    {
        $id = 1;
        $result = Term::query($this->db, 'show', $id);
        $this->runResultSelectTests($result);
    }

    public function testFind()
    {
        $result = Term::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testDisplay()
    {
        $result = Term::query($this->db, 'display');
        $this->runResultSelectTests($result);
    }

    public function testFindByType()
    {
        $type = '';
        $result = Term::query($this->db, 'findByType', $type);
        $this->runResultSelectTests($result);
    }
}
