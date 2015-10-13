<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\Sys\Model\Role;

class RoleTest extends ModelTestCase
{    
    public function testDisplay()
    {
        $result = Role::query($this->db, 'display');
        $this->runResultSelectTests($result);
    }

    public function testFind()
    {
        $result = Role::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testShow()
    {
        $id = 1;
        $result = Role::query($this->db, 'show', $id);
        $this->runResultSelectTests($result);
    }

    public function testInsert()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                'name' => 'admin',
            )
        );
        $result = Role::query($this->db, 'insert', $record);
        $this->runResultInsertTests($result);
    }

    public function testUpdate()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                'id' => 1,
                'name' => 'admin',
            )
        );
        $result = Role::query($this->db, 'update', $record);
        $this->runResultUpdateTests($result);
    }

    public function testDelete()
    {
        $id = 1;
        $result = Role::query($this->db, 'delete', $id);
    }
}
