<?php

namespace Maltz\Http;

class Session extends Collection
{

    protected $id;

    public function __construct()
    {

        if (!$this->started()) {
            session_start();
        }
        
        $this->map($_SESSION);
    }

    public function started()
    {
        if (session_status() === PHP_SESSION_NONE) {
            return false;
        }

        return true;
    }

    public function end()
    {
        unset($_SESSION);
        session_destroy();
    }

    public function renew($delete = false)
    {
        session_regenerate_id($delete);
    }

    public function get($id)
    {
        $id = str_replace('.', '_', $id);
        if (isset($_SESSION[$id]) && isset($this->items[$id]) && $_SESSION[$id] === $this->items[$id]) {
            return $this->items[$id];
        }
        return false;
    }

    public function set($id, $item)
    {
        $id = str_replace('.', '_', $id);
        $_SESSION[$id] = $item;
        parent::set($id, $item);
    }

    public function remove($id)
    {
        $id = str_replace('.', '_', $id);
        unset($_SESSION[$id]);
        parent::remove($id);
    }
}
