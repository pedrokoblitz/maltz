<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
<<<<<<< HEAD
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
=======
use Maltz\Sys\Model\User;

class InvoiceTest extends ModelTestCase
{

>>>>>>> 581057e42a9309b414205b42da284398c82a35a0
}
