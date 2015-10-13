<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\Project\Model\Invoice;

class InvoiceTest extends ModelTestCase
{
    public function testInsert()
    {
        $faker = \Faker\Factory::create('pt_BR');
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
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Invoice::query($this->db, 'update', $record);
        $this->runResultUpdateTests($result);
    }

    public function testProcessRecord()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $record = new Record(
            array(
                '' => '',
            )
        );
        $result = Invoice::query($this->db, 'processRecord', $record);
    }

    public function testShow()
    {
        $id = 1;
        $result = Invoice::query($this->db, 'show', $id);
        $this->runResultSelectTests($result);
    }

    public function testFind()
    {
        $result = Invoice::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testSetSent()
    {
        $id = 1;
        $result = Invoice::query($this->db, 'setSent', $id);
        $this->runResultUpdateTests($result);
    }

    public function testSetContested()
    {
        $id = 1;
        $result = Invoice::query($this->db, 'setContested', $id);
        $this->runResultUpdateTests($result);
    }

    public function testSetPaid()
    {
        $id = 1;
        $result = Invoice::query($this->db, 'setPaid', $id);
        $this->runResultUpdateTests($result);
    }
}
