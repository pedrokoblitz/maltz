<?php

namespace Maltz\Project\Model;

class Invoice
{
	public function __construct($db)
	{
		$rules = array(
			'' => '',
			);
		parent::__construct($db, 'invoice', 'invoices', $rules);
	}

	// CRUD
	
	public function insert(Record $record)
	{
		$sql = "INSERT INTO invoices (project_id, hours, rate, total, activity, created) 
  			VALUES (:project_id, :totalhours, :rate, :total, 1, NOW())";
		$resultado = $this->db->run($sql, $record->toArray());
		return $resultado;
	}

	public function processRecord(Record $record)
	{
		$total = (int) $record->get('totalhours') * (int) $record->get('rate');
		$record->set('total', $total);
		return $record;
	}

	public function show($id)
	{
		$sql = "SELECT t1.id, t2.title AS project, t1.hours, t1.rate, t1.total, t1.activity, t1.created FROM invoices
		  JOIN projects t2
		    ON t1.project_id=t2.id
		  WHERE t1.id=:id";
		$resultado = $this->db->run($sql, array('id' => $id));
		return $resultado;
	}

	public function find()
	{
		$sql = "SELECT t1.id, t2.title AS project, t1.hours, t1.rate, t1.total, t1.activity, t1.created FROM invoices
		  JOIN projects t2
		    ON t1.project_id=t2.id
		  ORDER BY $key $order
		  LIMIT $pagination->offset, $pagination->limit";
		$resultado = $this->db->run($sql);
		return $resultado;
	}

	// ACTIONS

	public function getProjectBillableHours($project_id)
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

	public function create($project_id, $rate)
	{
		$project = $this->getProjectBillableHours($project_id)->getFirstRecord();
		$resultado = $this->db->run($sql, array('project_id' => $project_id));
		return $resultado;
	}

	// ACTIVITY

	public function setSent($id)
	{
		$sql = "";
		$resultado = $this->db->run($sql, array());
		return $resultado;
	}

	public function setContested($id)
	{
		$sql = "";
		$resultado = $this->db->run($sql, array());
		return $resultado;
	}

	public function setPaid($id)
	{
		$sql = "";
		$resultado = $this->db->run($sql, array());
		return $resultado;
	}
}
