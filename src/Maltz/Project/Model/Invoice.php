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
