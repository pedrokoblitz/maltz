<?php

namespace Test\Model;

use Test\ModelTestCase;
use Maltz\Mvc\Record;
use Maltz\Mvc\Result;
use Maltz\Package\Sys\Model\Token;

class TokenTest extends ModelTestCase
{
    public function testGenerate()
    {
        $type = '';
        $result = Token::query($this->db, 'generate', $type);
        $this->runResultInsertTests($result);
    }

    public function testValidate()
    {
        $token = '';
        $type = '';
        $result = Token::query($this->db, 'validate', $token, $type);
    }
}
