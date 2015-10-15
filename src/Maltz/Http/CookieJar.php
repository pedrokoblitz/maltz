<?php

namespace Maltz\Http;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

class CookieJar extends Collection
{

    /**
     * /
     */
    public function __construct()
    {
        $this->items = $_COOKIE;
    }

    /**
     * /
     * @param [type] $id     [description]
     * @param array  $cookie [description]
     */
    public function set($id, array $cookie)
    {
        if (!is_string($id)) {
            throw new \Exception("Cookie index must be string", 001);
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

    /**
     * /
     * @param  [type]  $id [description]
     * @return boolean     [description]
     */
    public function has($id)
    {
        $newId = str_replace('.', '_', $id);
        return parent::has($newId);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function remove($id)
    {
        if (!is_string($id)) {
            throw new \Exception("Cookie index must be string", 002);
        }

        $newId = str_replace('.', '_', $id);
        setcookie($newId, '', time() - 3600);
        parent::remove($newId);
    }

    /**
     * /
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function get($id)
    {
        if (!is_string($id)) {
            throw new \Exception("Cookie index must be string", 003);
        }

        $newId = str_replace('.', '_', $id);
        $value = parent::get($newId);
        return new Cookie($value);
    }
}
