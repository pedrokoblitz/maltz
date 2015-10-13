<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\Content\Model\Collection;

class CollectionTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                'type_id' => 1,
                'parent_id' => 0,
                'language' => 'pt-br',
                'title' => $faker->sentence(),
                'description' => $faker->sentences(),
            )
        );
        $result = Collection::query($this->db, 'insert', $record);
        $this->runResultInsertTests($result);
    }

    public function testUpdate()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                'id' => 1,
                'type_id' => 1,
                'parent_id' => 0,
                'language' => 'pt-br',
                'title' => $faker->sentence(),
                'description' => $faker->sentences(),
            )
        );
        $result = Collection::query($this->db, 'update', $record);
        $this->runResultUpdateTests($result);
    }

    public function testDisplay()
    {
        $result = Collection::query($this->db, 'display');
        $this->runResultSelectTests($result);
    }

    public function testFind()
    {
        $result = Collection::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testFindByType()
    {
        $type = '';
        $result = Collection::query($this->db, 'findByType', $type);
        $this->runResultSelectTests($result);
    }

    public function testShow()
    {
        $id = 1;
        $result = Collection::query($this->db, 'show', $id);
        $this->runResultSelectTests($result);
    }
}
