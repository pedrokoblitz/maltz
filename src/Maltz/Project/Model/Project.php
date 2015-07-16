<?php

namespace Maltz\Project\Model;

class Project
{
	public function __construct($db)
	{
		$rules = array(
			'' => '',
			);
		parent::__construct($db, 'project', 'projects', $rules);
	}

	public function insert(Record $record)
	{
		$sql = "";
		$resultado = $this->db->run($sql, array());
		return $resultado;
	}

	public function update(Record $record)
	{
		$sql = "";
		$resultado = $this->db->run($sql, array());
		return $resultado;
	}

	public function show($id)
	{
		$sql = "";
		$resultado = $this->db->run($sql, array());
		return $resultado;
	}

	public function find()
	{
		$sql = "";
		$resultado = $this->db->run($sql, array());
		return $resultado;
	}

	public function getDevs($id)
	{
		$sql = "";
		$resultado = $this->db->run($sql, array());
		return $resultado;
	}

	public function getUsers($id)
	{
		$sql = "SELECT t1.id, t1.username, t1.name, t1.email
		FROM users t1
		JOIN users_projects t2
			ON t1.id=t2.user_id
		WHERE t2.project_id=:project_id";
		$resultado = $this->db->run($sql, array('project_id' => $id));
		return $resultado;
	}

	public function getTickets($id)
	{
		$sql = "SELECT id, dev_id, project_id FROM tickets WHERE project_id=:project_id";
		$resultado = $this->db->run($sql, array('project_id' => $project_id));
		return $resultado;
	}

	public function getBillableHours($id)
	{
		$sql = "SELECT
		    SEC_TO_TIME(SUM(TIME_TO_SEC(timediff(t1.start, t1.stop)))) AS totalhours,
		    totalhours * t4.rate AS total,
		    t3.title AS title -- add activity for proj report and proj.title for full report
			  FROM ticket_time_tracking t1 
			  JOIN tickets t2
			    ON t1.ticket_id=t2.id
			  JOIN projects t3
			    ON t2.project_id=t3.id
			  JOIN users t4
			    ON t1.dev_id=t4.id
			  WHERE t2.project_id=:project_id -- (remove for total report)
			    AND t2.activity = :activity";
		$resultado = $this->db->run($sql, array('activity' => 4, 'project_id' => $project_id));
		return $resultado;
	}

	public function createInvoice()
	{
		$record = $this->getBillableHours()->getFirstRecord();
		$record->set('',);
		return Invoice::query('save', $record);
	}

}
