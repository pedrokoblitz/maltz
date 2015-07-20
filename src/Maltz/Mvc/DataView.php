<?php

namespace Maltz\Mvc;

class DataView
{
    protected $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }
}
