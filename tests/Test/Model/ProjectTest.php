<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Project\Model\Project;

class ProjectTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create();
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
        $faker = \Faker\Factory::create();
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Project::query($this->db, 'update', $record);
    }

    public function testShow()
    {
        $id = 1;
        $result = Project::query($this->db, 'show', $id);
    }

    public function testFind()
    {
        $result = Project::query($this->db, 'find');
    }

    public function testGetDevs()
    {
        $id = 1;
        $result = Project::query($this->db, 'getDevs', $id);
    }

    public function testAddUser()
    {
        $id = 1;
        $userId = 1;
        $result = Project::query($this->db, 'addUser', $id, $userId);
    }

    public function testRemoveUser()
    {
        $id = 1;
        $userId = 1;
        $result = Project::query($this->db, 'removeUser', $id, $userId);
    }

    public function testGetUsers()
    {
        $id = 1;
        $result = Project::query($this->db, 'getUsers', $id);
    }

    public function testGetTickets()
    {
        $id = 1;
        $result = Project::query($this->db, 'getTickets', $id);
    }

    public function testGetInvoices()
    {
        $id = 1;
        $result = Project::query($this->db, 'getInvoices', $id);
    }

    public function testGetBillableHours()
    {
        $id = 1;
        $result = Project::query($this->db, 'getBillableHours', $id);
    }

    public function testCreateReport()
    {
        $id = 1;
        $result = Project::query($this->db, 'createReport', $id);
    }

    public function testCreateInvoice()
    {
        $id = 1;
        $result = Project::query($this->db, 'createInvoice', $id);
    }
}
