<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\Sys\Model\User;

class UserTest extends ModelTestCase
{
    public function testFind()
    {
        $result = User::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testShow()
    {
        $id = 1;
        $result = User::query($this->db, 'show', $id);
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
        $result = User::query($this->db, 'insert', $record);
        $this->runResultInsertTests($result);
    }

    public function testUpdate()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                'name' => 'admin',
            )
        );
        $result = User::query($this->db, 'update', $record);
        $this->runResultUpdateTests($result);
    }

    public function testSignUp()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                'name' => 'admin',
            )
        );
        $result = User::query($this->db, 'signUp', $record);
        $this->runResultInsertTests($result);
    }

    public function testRemember()
    {
        $id = 1;
        $result = User::query($this->db, 'remember', $id);
    }

    public function testForgot()
    {
        $id = 1;
        $result = User::query($this->db, 'forgot', $id);
    }

    public function testValidate()
    {
        $id = 1;
        $result = User::query($this->db, 'validate', $id);
    }
}
