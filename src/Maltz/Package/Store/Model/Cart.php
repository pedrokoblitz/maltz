<?php

namespace Maltz\Package\Store\Model;

class Cart
{
    protected $cookie;

    public function __construct($db, $cookieJar)
    {
        $this->db = $db;
        $this->cookie = $cookie;
    }
}
