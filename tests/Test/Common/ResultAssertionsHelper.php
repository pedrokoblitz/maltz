<?php

namespace Test\Common;

trait ResultAssertionsHelper
{
    public function runResultTests($result)
    {
        $this->assertInstanceOf('Result', $result);
        $resultArray = $result->toArray();
        $this->assertTrue(is_array($resultArray));
        $this->assertArrayHasKey('success', $resultArray);
        $this->assertArrayHasKey('message', $resultArray);
        $this->assertTrue($result->isSuccessful() === true);
        $this->assertTrue(is_string($result->getMessage()));
    }

    public function runResultSelectTests($result)
    {
        $this->runResultTests($result);
        $resultArray = $result->toArray();
        $this->assertArrayHasKey('records', $resultArray);
        $this->assertTrue(is_array($result->getRecords()));
        $this->assertContainsOnlyInstancesOf('Record', $result->getRecords());
    }

    public function runResultInsertTests($result)
    {
        $this->runResultTests($result);
        $resultArray = $result->toArray();
        $this->assertArrayHasKey('last.insert.id', $resultArray);
    }

    public function runResultUpdateTests($result)
    {
        $this->runResultTests($result);
    }

    public function runResultDeleteTests($result)
    {
        $this->runResultTests($result);
    }
}
