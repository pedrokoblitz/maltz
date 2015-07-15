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

	public function storeUploadedResources($user_id, array $records)
	{
		$this->session->set('uploaded.resources', $records);
	}

	public function getUploadedResources()
	{
		return $this->session('uploaded.resources');
	}

	public function storeGroupItems($user_id, $group_name, $group_id, array $records)
	{
		$this->session->set('group.items', array('user_id' => $user_id, 'group_name' => $group_name, 'group_id' => $group_id, 'records' => $records));
	}

	public function getGroupItems()
	{
		return $this->session('group.items');
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