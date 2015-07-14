<?php

namespace Maltz\Http;

class SessionDataStore
{
	protected $session;

	public function __construct(Session $session)
	{
		$this->session = $session;
	}

	public function storeUploadedResources(array $resources)
	{
		$this->session->set('uploaded.resources', $resources);
	}

	public function getUploadedResources()
	{
		return $this->session('uploaded.resources');
	}

	public function storeGroupItems($group_name, $group_id, $items)
	{
		$this->session->set('group.items', array('group_name' => $item_name, 'group_id' => $item_id, 'items' => $items));
	}

	public function getGroupItems()
	{
		return $this->session('group.items');
	}
}