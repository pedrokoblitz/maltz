<?php

namespace Maltz\Service;

use Maltz\Http\Session;
use Maltz\Mvc\Record;

class SessionDataStore
{
	protected $session;

	public function __construct(Session $session)
	{
		$this->session = $session;
	}

	private function generateKey($key)
	{
		return md5($key . 'salt@NR#KN#hash');
	}

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

	public function getMessages()
	{
		return $this->session->get('system.messages');
	}

	public function storeItems($key, $value)
	{
		$hash = $this->generateKey($key);
		$this->session->set($hash, $value);
	}

	public function getItems($hash)
	{
		$hash = $this->generateKey($key);
		return $this->session->get($key);
	}

	public function setUserData(Record $record)
	{
        $this->session->set('user.authenticated', true);
        $this->session->set('user.id', $record->get('id'));
        $this->session->set('user.username', $record->get('username'));
        $this->session->set('user.name', $record->get('name'));
        $this->session->set('user.email', $record->get('email'));
	}

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

	public function isUserAuthenticated()
	{
		return $this->session->get('user.authenticated') === true;
	}

	public function getUserId()
	{
		return $this->session->get('user.id');
	}

	public function getViewData()
	{
		$data = array(
			'messages' => $this->getMessages(),
			'user' => $this->getUserData()
			);
		return $data;
	}

	public function destroy()
	{
		$this->session->end();
	}
}