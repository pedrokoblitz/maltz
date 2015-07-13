<?php

namespace Maltz\Http;

class Cookie
{
    protected $cookie;

    protected $encryption;

    protected $safe = true;

    public function __construct($value, $expires = null, $domain = null, $path = null, $secure = false, $httponly = false)
    {

        $this->cookie = array(
            'value' => $value,
            'expires' => $expires,
            'path' => $path,
            'domain' => $domain,
            'secure' => false,
            'httponly' => false,
        );
    }

    public function get()
    {
        return $this->cookie;
    }

    public function setDomain($domain)
    {
        $this->cookie['domain'] = $domain;
    }

    public function setPath($path)
    {
        $this->cookie['path'] = $path;
    }

    public function setExpiration($expires)
    {
        $this->cookie['expires'] = $expires;
    }

    public function setSecure()
    {
        $this->cookie['secure'] = true;
    }

    public function setHttpOnly()
    {
        $this->cookie['httponly'] = true;
    }
}
