<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\SiteBuilding\Model\Area;

class AreaTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create();
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Area::query($this->db, 'insert', $record);
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
        $result = Area::query($this->db, 'update', $record);
    }

    public function testDisplay()
    {
        $result = Area::query($this->db, 'display');
    }

    public function testFind()
    {
        $result = Area::query($this->db, 'find');
    }

    public function testShow()
    {
        $id = 1;
        $result = Area::query($this->db, 'show', $id);
    }

    public function testAddBlock()
    {
        $result = Area::query($this->db, 'addBlock');
    }

    public function testRemoveBlock()
    {
        $result = Area::query($this->db, 'removeBlock');
    }

    public function testGetBlocks()
    {
        $result = Area::query($this->db, 'getBlock');
    }
}
