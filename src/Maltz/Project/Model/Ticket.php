<?php

namespace Maltz\Tickets\Model;

class Ticket
{
	public function __construct($db)
	{
		$rules = array(
			'id' => 'int',
			'dev_id' => 'int',
			'user_id' => 'int',
			'hash' => 'string',
			'description' => 'textarea',
			'priority' => 'int',
			'activity' => 'int'
			);
		parent::__construct($db, 'ticket', 'tickets', $rules);
	}

	public function show($id)
	{
		$sql = "SELECT (id, dev_id, user_id, hash, priority, description, activity, created, modified) 
			FROM tickets
				WHERE id=:id";
		$resultado = $this->db->run($sql, array('id' => $id));
		return $resultado;
	}

	public function insert(Record $record)
	{
		$sql = "INSERT INTO tickets (dev_id, user_id, hash, priority, description, activity, created, modified) 
			VALUES (:dev_id, :user_id, MD5(NOW()), :priority, :description, :activity, NOW(), NOW())";
		$resultado = $this->db->run($sql, $record->toArray());
		return $resultado;
	}

	public function find($key = 'modified')
	{
		$sql = "SELECT (dev_id, user_id, hash, priority, description, activity, created, modified) FROM tickets
			WHERE activity > 1
			ORDER BY $key DESC";
		$resultado = $this->db->run($sql);
		return $resultado;
	}

	public function findAll($page = 1, $per_page = 20)
	{
        $pagination = Pagination::paginate($page, $per_page);
		$sql = "SELECT (dev_id, user_id, hash, priority, description, activity, created, modified) FROM tickets
			ORDER BY modified DESC, activity DESC, priority DESC
            LIMIT $pagination->offset,$pagination->limit";
		$resultado = $this->db->run($sql);
		return $resultado;
	}

	public function changePriority($id, $priority)
	{
		$sql = "UPDATE SET priority=:priority, modified=NOW() WHERE id=:id";
		$resultado = $this->db->run($sql, array('id' => $id, 'priority' => $priority));
		return $resultado;
	}

	public function delete($id)
	{
		$sql = "UPDATE SET activity=:activity, modified=NOW() WHERE id=:id";
		$resultado = $this->db->run($sql, array('activity' => 0, 'id' => $id));
		return $resultado;
	}

	public function close($id)
	{
		$sql = "UPDATE SET activity=:activity, modified=NOW() WHERE id=:id";
		$resultado = $this->db->run($sql, array('activity' => 1, 'id' => $id));
		return $resultado;
	}

	public function getUserEmail($ticket_id)
	{
		$sql = "SELECT t2.email FROM tickets t1
			JOIN users t2
				ON t1.user_id=t2.id
			WHERE t1.id=:ticket_id";
		$resultado = $this->db->run($sql, array('ticket_id' => $ticket_form));
		return $resultado->getFirstRecord()->get('email');
	}

	public function getDevEmail($ticket_id)
	{
		$sql = "SELECT t2.email FROM tickets t1
			JOIN users t2
				ON t1.dev_id=t2.id
			WHERE t1.id=:ticket_id";
		$resultado = $this->db->run($sql, array('ticket_id' => $ticket_form));
		return $resultado->getFirstRecord()->get('email');
	}
}