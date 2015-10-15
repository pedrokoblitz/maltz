<?php

namespace Maltz\Service;

use Maltz\Http\Session;

class Nonce
{
    /**
     * [$session description]
     * @var [type]
     */
    protected $session;

    /**
     * /
     * @param Session $session [description]
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function generate()
    {
        $token = md5(microtime() . 'm4a3l2t1z');
        $this->session->set('token.nonce', $token);
    }

    /**
     * /
     * @return [type] [description]
     */
    public function get()
    {
        return $this->session->get('token.nonce');
    }

    /**
     * /
     * @param  [type] $token [description]
     * @return [type]        [description]
     */
    public function verify($token)
    {
        $nonce = $this->session->get('token.nonce');
        return (string) $token === (string) $nonce;
    }
}
