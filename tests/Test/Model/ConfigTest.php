<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\Sys\Model\Config;

class ConfigTest extends ModelTestCase
{
    public function testDisplay()
    {
        $result = Config::query($this->db, 'display');
        $this->runResultSelectTests($result);
    }

    public function testFind()
    {
        $result = Config::query($this->db, 'find');
        $this->runResultSelectTests($result);
    }

    public function testShow()
    {
        $id = 1;
        $result = Config::query($this->db, 'show', $id);
        $this->runResultSelectTests($result);
    }

    public function testSetValue()
    {
        $key = '';
        $value = '';
        $result = Config::query($this->db, 'setValue', $key, $value);
        $this->runResultInsertTests($result);
    }

    public function testGetValue()
    {
        $key = '';
        $result = Config::query($this->db, 'getValue', $key);
        $this->runResultSelectTests($result);
    }

    public function testSetRefresh()
    {
        $key = '';
        $result = Config::query($this->db, 'setRefresh', $key);
        $this->runResultUpdateTests($result);
    }

    public function testRefresh()
    {
        $key = '';
        $result = Config::query($this->db, 'refresh', $key);
        $this->runResultUpdateTests($result);
    }
}
