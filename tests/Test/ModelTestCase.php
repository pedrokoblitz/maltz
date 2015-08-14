<?php

namespace Test;

use Maltz\Mvc\DB;

class ModelTestCase extends \PHPUnit_Framework_TestCase
{
    public function __construct()
    {
        $this->db = new DB('mysql://localhost&dbname=maltz', 'root', 'root');
    }
}
