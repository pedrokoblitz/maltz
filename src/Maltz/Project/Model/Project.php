<?php

namespace Maltz\Project\Model;

use Maltz\Mvc\Record;
use Maltz\Service\Pagination;

class Project
{
	public function __construct($db)
	{
		$rules = array(
			'title' => 'string',
			'description' => 'textarea',
			'activity' => 'int'
			);
		parent::__construct($db, 'project', 'projects', $rules);
	}

	public function insert(Record $record)
	{
		$sql = "INSERT INTO projects (title, description, activity) VALUES (:title, :description, :activity)";
		$resultado = $this->db->run($sql, $record->toArray());
		return $resultado;
	}

	public function update(Record $record)
	{
		$sql = "UPDATE projects SET title=:title, description=:description, activity=:activity";
		$resultado = $this->db->run($sql, $record->toArray());
		return $resultado;
	}

	public function show($id)
	{
		$sql = "SELECT title, description, activity FROM projects WHEERE id=:id";
		$resultado = $this->db->run($sql, array('id' => $id));
		return $resultado;
	}

	public function find($pg = 1, $per_page = 12, $key = 'title', $order = 'asc')
	{
		$pagination = Pagination::paginate($pg, $per_page);
		$sql = "SELECT title, description, activity FROM projects
		ORDER BY $key $order
		LIMIT $pagination->offset, $pagination->limit
		WHERE activity > :activity";
		$resultado = $this->db->run($sql, array('activity' => 0));
		return $resultado;
	}

	public function getDevs($id)
	{
		$sql = "SELECT t1.id, t1.username, t1.name, t1.email
		FROM users t1
		JOIN tickets t2
			ON t1.id=t2.dev_id
		WHERE t2.project_id=:project_id";
		$resultado = $this->db->run($sql, array('project_id' => $id));
		return $resultado;
	}

	public function getUsers($id)
	{
		$sql = "SELECT t1.id, t1.username, t1.name, t1.email
		FROM users t1
		JOIN items_groups_relationships t2
			ON t1.id=t2.item_id
			AND t2.item_name=:item_name
		WHERE t2.group_id=:project_id
			AND t2.group_name=:group_name";
		$resultado = $this->db->run($sql, array('group_name' => 'project', 'group_id' => $id, 'item_name' => 'user'));
		return $resultado;
	}

	public function getTickets($id)
	{
		$sql = "SELECT t1.id, t2.id as user_id, t2.name, t2.email FROM tickets t1 
		JOIN users t2
			ON t1.dev_id=t2.id
		WHERE project_id=:project_id";
		$resultado = $this->db->run($sql, array('project_id' => $project_id));
		return $resultado;
	}

	public function getInvoices($id)
	{
		$sql = "SELECT (dev_id, user_id, hash, priority, description, activity, created, modified) FROM tickets WHERE";
	}

	public function getBillableHours($id)
	{
		$sql = "SELECT
		    SEC_TO_TIME(SUM(TIME_TO_SEC(timediff(t1.start, t1.stop)))) AS totalhours,
		    t4.value as rate,
		    totalhours*rate AS total,
		    t3.title AS title -- add activity for proj report and proj.title for full report
			  FROM ticket_time_tracking t1 
			  JOIN tickets t2
			    ON t1.ticket_id=t2.id
			  JOIN projects t3
			    ON t2.project_id=t3.id
			  JOIN metadata t4
			    ON t1.dev_id=t4.item_id
			    AND t4.item_name=:user_item
			    AND t4.key=:meta_key
			  WHERE t2.project_id=:project_id -- (remove for total report)
			    AND t2.activity = :activity";
		$resultado = $this->db->run($sql, array('activity' => 4, 'project_id' => $id, 'user_item' => 'user', 'meta_key' => 'hourly_rate'));
		return $resultado;
	}

	public function createInvoice()
	{
		$record = $this->getBillableHours()->getFirstRecord();
		$record->set('activity', 1);
		return Invoice::query('save', $record);
	}
}
