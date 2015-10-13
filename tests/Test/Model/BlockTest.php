<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\SiteBuilding\Model\Block;

class BlockTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                'name' => $faker->word,
                'area_id' => 1
            )
        );
        $result = Block::query($this->db, 'insert', $record);
        $this->runResultInsertTests($result);
    }

    public function testUpdate()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                'id' => 1,
                'name' => $faker->word,
                'area_id' => 2
            )
        );
        $result = Block::query($this->db, 'update', $record);
        $this->runResultUpdateTests($result);
    }

    public function testDelete()
    {
        $id = 1;
        $result = Block::query($this->db, 'delete', $id);
        $this->runResultUpdateTests($result);
    }

    public function testDisplay()
    {
        $result = Block::query($this->db, 'display');
        $this->runResultSelectTests($result);
    }

    public function testFind()
    {
        $result = Block::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testShow()
    {
        $id = 1;
        $result = Block::query($this->db, 'show', $id);
        $this->runResultSelectTests($result);
    }
}
