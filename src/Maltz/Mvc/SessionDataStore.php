<?php

namespace Maltz\Mvc;

use Maltz\Http\Session;

class SessionDataStore
{
	protected $session;

	public function __construct(Session $session)
	{
		$this->session = $session;
	}

	private function generateKey($key)
	{
		return md5($key . 'hash-salt@NR#KN#');
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

	public function setUserData($data)
	{
        $this->session->set('user.authenticated', true);
        $this->session->set('user.id', $data['id']);
        $this->session->set('user.username', $data['username']);
        $this->session->set('user.name', $data['name']);
        $this->session->set('user.email', $data['email']);
	}

	public function isUserAuthenticated()
	{
		return $this->session->get('user.authenticated') === true;
	}

	public function getUserId()
	{
		return $this->session->get('user.id');
	}

	public function destroy()
	{
		$this->session->end();
	}
}