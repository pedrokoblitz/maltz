<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Project\Model\Ticket;

class TicketTest extends ModelTestCase
{
    public function testShow()
    {
        $id = 1;
        $result = Ticket::query($this->db, 'show', $id);
    }

    public function testInsert()
    {
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
    }

    public function testFindAll()
    {
        $result = Ticket::query($this->db, 'findAll');
    }

    public function testChangePriority()
    {
        $id = 1;
        $priority = '';
        $result = Ticket::query($this->db, 'changePriority', $id, $priority);
    }

    public function testClose()
    {
        $id = 1;
        $result = Ticket::query($this->db, 'close', $id);
    }

    public function testGetDev()
    {
        $id = 1;
        $result = Ticket::query($this->db, 'getDev', $id);
    }
}
