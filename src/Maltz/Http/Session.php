<?php

namespace Maltz\Http;

class Session extends Collection
{

    protected $id;

    /**
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        if (!$this->started()) {
            session_start();
        }
        
        $this->map($_SESSION);
    }

    /**
     * Has session started?
     * @access public
     * @return bool yes or no
     */
    public function started()
    {
        if (session_status() === PHP_SESSION_NONE) {
            return false;
        }

        return true;
    }

    /**
     * Ends current session
     * 
     * @access public
     * @return void
     */
    public function end()
    {
        unset($_SESSION);
        session_destroy();
    }

    /**
     * @access public
     * @param  boolean $delete [description]
     * @return [type]          [description]
     */
    public function renew($delete = false)
    {
        session_regenerate_id($delete);
    }

    /**
     * @access public
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function get($id)
    {
        $id = str_replace('.', '_', $id);
        if (isset($_SESSION[$id]) && isset($this->items[$id]) && $_SESSION[$id] === $this->items[$id]) {
            return $this->items[$id];
        }
        return false;
    }

    /**
     * @access public
     * @param [type] $id   [description]
     * @param [type] $item [description]
     */
    public function set($id, $item)
    {
        if ($id === 'slim.flash') {
            return;
        }
        $id = str_replace('.', '_', $id);
        $_SESSION[$id] = $item;
        parent::set($id, $item);
    }

    /**
     * @access public
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function remove($id)
    {
        $id = str_replace('.', '_', $id);
        unset($_SESSION[$id]);
        parent::remove($id);
    }
}
