<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\SiteBuilding\Model\Area;

class AreaTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                'name' => $faker->word,
                'activity' => 1
            )
        );
        $result = Area::query($this->db, 'insert', $record);
        $this->runResultInsertTests($result);
    }

    public function testUpdate()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                'id' => 1,
                'name' => $faker->word,
                'activity' => 1
            )
        );
        $result = Area::query($this->db, 'update', $record);
        $this->runResultUpdateTests($result);
    }

    public function testDisplay()
    {
        $result = Area::query($this->db, 'display');
        $this->runResultSelectTests($result);
    }

    public function testFind()
    {
        $result = Area::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testShow()
    {
        $id = 1;
        $result = Area::query($this->db, 'show', $id);
        $this->runResultSelectTests($result);
    }

    public function testAddBlock()
    {
        $id = 1;
        $block_id = 1;
        $result = Area::query($this->db, 'addBlock', $id, $block_id);
        $this->runResultUpdateTests($result);
    }

    public function testRemoveBlock()
    {
        $block_id = 1;
        $result = Area::query($this->db, 'removeBlock', $block_id);
        $this->runResultUpdateTests($result);
    }

    public function testGetBlocks()
    {
        $id = 1;
        $result = Area::query($this->db, 'getBlock', $id);
        $this->runResultSelectTests($result);
    }
}
