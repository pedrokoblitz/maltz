<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\Project\Model\Ticket;

class TicketTest extends ModelTestCase
{
    public function testShow()
    {
        $id = 1;
        $result = Ticket::query($this->db, 'show', $id);
        $this->runResultSelectTests($result);
    }

    public function testInsert()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Ticket::query($this->db, 'insert', $record);
        $this->runResultInsertTests($result);
    }

    public function testFind()
    {
        $result = Ticket::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testFindAll()
    {
        $result = Ticket::query($this->db, 'findAll');
        $this->runResultSelectTests($result);
    }

    public function testChangePriority()
    {
        $id = 1;
        $priority = '';
        $result = Ticket::query($this->db, 'changePriority', $id, $priority);
        $this->runResultUpdateTests($result);
    }

    public function testClose()
    {
        $id = 1;
        $result = Ticket::query($this->db, 'close', $id);
        $this->runResultUpdateTests($result);
    }

    public function testGetDev()
    {
        $id = 1;
        $result = Ticket::query($this->db, 'getDev', $id);
        $this->runResultSelectTests($result);
    }
}
