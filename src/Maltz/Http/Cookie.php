<?php

namespace Maltz\Http;

class Cookie
{
    /**
     * [$cookie description]
     * @var [type]
     */
    protected $cookie;

    /**
     * [$encryption description]
     * @var [type]
     */
    protected $encryption;

    /**
     * [$safe description]
     * @var boolean
     */
    protected $safe = true;

    /**
     * /
     * @param [type]  $value    [description]
     * @param [type]  $expires  [description]
     * @param [type]  $domain   [description]
     * @param [type]  $path     [description]
     * @param boolean $secure   [description]
     * @param boolean $httponly [description]
     */
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

    /**
     * /
     * @return [type] [description]
     */
    public function get()
    {
        return $this->cookie;
    }

    /**
     * /
     * @param [type] $domain [description]
     */
    public function setDomain($domain)
    {
        $this->cookie['domain'] = $domain;
    }

    /**
     * /
     * @param [type] $path [description]
     */
    public function setPath($path)
    {
        $this->cookie['path'] = $path;
    }

    /**
     * /
     * @param [type] $expires [description]
     */
    public function setExpiration($expires)
    {
        $this->cookie['expires'] = $expires;
    }

    /**
     * /
     */
    public function setSecure()
    {
        $this->cookie['secure'] = true;
    }

    /**
     * /
     */
    public function setHttpOnly()
    {
        $this->cookie['httponly'] = true;
    }
}
