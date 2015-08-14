<?php

namespace Test\Model;

class LogTest extends ModelTestCase
{
    public function testFind()
    {
        $this->runResultSelectTests($result);
    }

    public function testInsert()
    {
        $this->runResultInsertTests($result);
    }

    public function testLog()
    {
        
    }
}
