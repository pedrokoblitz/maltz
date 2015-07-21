<?php

namespace Maltz\Service;

use Maltz\Http\Session;

class Nonce
{
    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function generate()
    {
        $token = md5(microtime() . 'm4a3l2t1z');
        $this->session->set('token.nonce', $token);
    }

    public function get()
    {
        return $this->session->get('token.nonce');
    }

    public function verify($token)
    {
        $nonce = $this->session->get('token.nonce');
        return (string) $token === (string) $nonce;
    }
}
