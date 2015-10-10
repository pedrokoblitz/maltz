<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Sys\Model\Token;

class TokenTest extends ModelTestCase
{
    public function testGenerate()
    {
        $userId = 1;
        $result = Token::query($this->db, 'generate');
        $this->runResultInsertTests($result);
    }

    public function testValidate()
    {
        $token = '';
        $result = Token::query($this->db, 'validate', $token);
    }
}
