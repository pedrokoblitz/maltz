<?php

namespace Test\Model;

class ConfigTest extends ModelTestCase
{
    public function testDisplay()
    {
        $this->runResultSelectTests($result);
    }

    public function testFind()
    {
        $this->runResultSelectTests($result);
    }

    public function testShow()
    {
        $this->runResultSelectTests($result);
    }

    public function testSetValue()
    {
        $this->runResultInsertTests($result);
    }

    public function testGetValue()
    {
        $this->runResultSelectTests($result);
    }

    public function testSetRefresh()
    {
        $this->runResultUpdateTests($result);
    }

    public function testRefresh()
    {
        
    }
}
