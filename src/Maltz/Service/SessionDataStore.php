<?php

namespace Maltz\Service;

use Maltz\Http\Session;
use Maltz\Mvc\Record;

class SessionDataStore
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
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    private function generateKey($key)
    {
        return md5($key . 'salt@NR#KN#hash');
    }

    /**
     * /
     * @param [type] $message [description]
     */
    public function addMessage($message)
    {
        if ($this->session->has('system.messages')) {
            $messages = $this->session->has('system.messages');
        } else {
            $messages = array();
        }
        $messages[] = $message;
        $this->session->set('system.messages', $messages);
    }

    /**
     * /
     * @return [type] [description]
     */
    public function getMessages()
    {
        return $this->session->get('system.messages');
    }

    /**
     * /
     * @param  [type] $key   [description]
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function storeItems($key, $value)
    {
        $hash = $this->generateKey($key);
        $this->session->set($hash, $value);
    }

    /**
     * /
     * @param  [type] $hash [description]
     * @return [type]       [description]
     */
    public function getItems($hash)
    {
        $hash = $this->generateKey($key);
        return $this->session->get($key);
    }

    /**
     * /
     * @param Record $record [description]
     */
    public function setUserData(Record $record)
    {
        $this->session->set('user.authenticated', true);
        $this->session->set('user.id', $record->get('id'));
        $this->session->set('user.username', $record->get('username'));
        $this->session->set('user.name', $record->get('name'));
        $this->session->set('user.email', $record->get('email'));
    }

    /**
     * /
     * @return [type] [description]
     */
    public function getUserData()
    {
        $data = array(
            'authenticated' => $this->session->get('user.authenticated'),
            'id' => $this->session->get('user.id'),
            'username' => $this->session->get('user.username'),
            'name' => $this->session->get('user.name'),
            'email' => $this->session->get('user.email'),
            );
        return $data;
    }

    /**
     * /
     * @return boolean [description]
     */
    public function isUserAuthenticated()
    {
        return $this->session->get('user.authenticated') === true;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function getUserId()
    {
        return $this->session->get('user.id');
    }

    /**
     * /
     * @return [type] [description]
     */
    public function getViewData()
    {
        $data = array(
            'messages' => $this->getMessages(),
            'user' => $this->getUserData()
            );
        return $data;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function destroy()
    {
        $this->session->end();
    }
}
