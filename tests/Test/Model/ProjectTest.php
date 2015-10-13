<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\Project\Model\Project;

class ProjectTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Project::query($this->db, 'insert', $record);
        $this->runResultInsertTests($result);
    }

    public function testUpdate()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Project::query($this->db, 'update', $record);
        $this->runResultUpdateTests($result);
    }

    public function testShow()
    {
        $id = 1;
        $result = Project::query($this->db, 'show', $id);
        $this->runResultSelectTests($result);
    }

    public function testFind()
    {
        $result = Project::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testGetDevs()
    {
        $id = 1;
        $result = Project::query($this->db, 'getDevs', $id);
        $this->runResultSelectTests($result);
    }

    public function testAddUser()
    {
        $id = 1;
        $userId = 1;
        $result = Project::query($this->db, 'addUser', $id, $userId);
        $this->runResultUpdateTests($result);
    }

    public function testRemoveUser()
    {
        $id = 1;
        $userId = 1;
        $result = Project::query($this->db, 'removeUser', $id, $userId);
        $this->runResultUpdateTests($result);
    }

    public function testGetUsers()
    {
        $id = 1;
        $result = Project::query($this->db, 'getUsers', $id);
        $this->runResultSelectTests($result);
    }

    public function testGetTickets()
    {
        $id = 1;
        $result = Project::query($this->db, 'getTickets', $id);
        $this->runResultSelectTests($result);
    }

    public function testGetInvoices()
    {
        $id = 1;
        $result = Project::query($this->db, 'getInvoices', $id);
        $this->runResultSelectTests($result);
    }

    public function testGetBillableHours()
    {
        $id = 1;
        $result = Project::query($this->db, 'getBillableHours', $id);
        $this->runResultSelectTests($result);
    }

    public function testCreateReport()
    {
        $id = 1;
        $result = Project::query($this->db, 'createReport', $id);
        $this->runResultSelectTests($result);
    }

    public function testCreateInvoice()
    {
        $id = 1;
        $result = Project::query($this->db, 'createInvoice', $id);
        $this->runResultInsertTests($result);
    }
}
