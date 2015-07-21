<?php

namespace Maltz\Http;

class CookieJar extends Collection
{

    public function __construct()
    {
        $this->items = $_COOKIE;
    }

    public function set($id, array $cookie)
    {
        if (!is_string($id)) {
            throw new \Exception("Error Processing Request");
        }

        $newId = str_replace('.', '_', $id);
        setcookie(
            $newId,
            $cookie['value'],
            isset($cookie['expires']) ? $cookie['expires'] : null,
            isset($cookie['path']) ? $cookie['path'] : null,
            isset($cookie['domain']) ? $cookie['domain'] : null,
            isset($cookie['secure']) ? $cookie['secure'] : null,
            isset($cookie['httponly']) ? $cookie['httponly'] : null
        );
        parent::set($id, $cookie);
    }

    public function has($id)
    {
        $newId = str_replace('.', '_', $id);
        return parent::has($newId);
    }

    public function remove($id)
    {
        if (!is_string($id)) {
            throw new \Exception("Error Processing Request");
        }

        $newId = str_replace('.', '_', $id);
        setcookie($newId, '', time() - 3600);
        parent::remove($newId);
    }

    public function get($id)
    {
        if (!is_string($id)) {
            throw new \Exception("Error Processing Request");
        }

        $newId = str_replace('.', '_', $id);
        $value = parent::get($newId);
        return new Cookie($value);
    }
}
