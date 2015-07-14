<?php

namespace Maltz\Http;

class Nonce
{
    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function generate()
    {
        $token = sha1(microtime() . 'm4a3l2t1z');
        $this->session->set('token.nonce', $token);
    }

    public function verify($token)
    {
        $nonce = $this->session->get('token.nonce');
        if ($token === $nonce) {
            return true;
        }
        return false;
    }
}