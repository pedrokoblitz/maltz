<?php

namespace Maltz\Http;

class SessionCookieAuthHandler
{

    protected $session;

    protected $cookieJar;

    protected $allowedKeys;

    public function __construct(Session $session, CookieJar $cookieJar, array $keys)
    {
        $this->session = $session;
        $this->cookieJar = $cookieJar;
        $this->allowedKeys = $keys;
    }

    public function reflectSessionInCookie()
    {
        foreach ($this->keys as $key) {
            $item = $this->session->get($key);
            $this->cookieJar->set($key, $item);
        }
    }

    public function reflectCookieInSession()
    {
        foreach ($this->keys as $key) {
            $item = $this->cookieJar->get($key);
            $this->session->set($key, $item->all());
        }
    }

    protected function extract(Collection $collection)
    {
        $data = array();

        foreach ($this->keys as $key) {
            $data[$key] = $collection->get($key);
        }
        return $data;
    }

    public function check()
    {

        $sessionData = $this->extract($this->session);
        $cookieData = $this->extract($this->cookieJar);

        return $sessionData === $cookieData;
    }
}
