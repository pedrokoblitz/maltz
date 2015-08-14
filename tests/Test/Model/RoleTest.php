<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Sys\Model\Role;

class RoleTest extends ModelTestCase
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Role($this->db);
    }
    
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
        $faker = \Faker\Factory::create();
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
        $faker = \Faker\Factory::create();
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
