<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Sys\Model\User;

class UserTest extends ModelTestCase
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new User($this->db);
    }
    
    public function testFind()
    {
        User::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testShow()
    {
        $id = 1;
        User::query($this->db, '');
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
        User::query($this->db, '');
        $this->runResultInsertTests($result);
    }

    public function testUpdate()
    {
        $faker = \Faker\Factory::create();
        $record = new Record(
            array(
                'name' => 'admin',
            )
        );
        User::query($this->db, '');
        $this->runResultUpdateTests($result);
    }

    public function testSignUp()
    {
        $faker = \Faker\Factory::create();
        $record = new Record(
            array(
                'name' => 'admin',
            )
        );
        User::query($this->db, '');
        $this->runResultInsertTests($result);
    }

    public function testRemember()
    {
        User::query($this->db, '');
    }

    public function testForgot()
    {
        User::query($this->db, '');
    }

    public function testValidate()
    {
        User::query($this->db, '');
    }
}
