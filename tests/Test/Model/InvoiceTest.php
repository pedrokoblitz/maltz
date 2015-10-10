<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Project\Model\Invoice;

class InvoiceTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create();
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Invoice::query($this->db, 'insert', $record);
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
        $result = Invoice::query($this->db, 'update', $record);
    }

    public function testProcessRecord()
    {
        $result = Invoice::query($this->db, 'processRecord');
    }

    public function testShow()
    {
        $id = 1;
        $result = Invoice::query($this->db, 'show', $id);
    }

    public function testFind()
    {
        $result = Invoice::query($this->db, 'find');
    }

    public function testSetSent()
    {
        $id = 1;
        $result = Invoice::query($this->db, 'setSent', $id);
    }

    public function testSetContested()
    {
        $id = 1;
        $result = Invoice::query($this->db, 'setContested', $id);
    }

    public function testSetPaid()
    {
        $id = 1;
        $result = Invoice::query($this->db, 'setPaid', $id);
    }
}
