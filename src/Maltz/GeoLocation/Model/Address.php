<?php

namespace Maltz\Geo\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;

class Address
{
    public function __construct(DB $db)
    {
        parent::__construct($db);
    }
}