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
		$sql = "";
		$resultado = $this->db->run($sql, array());
		return $resultado;
	}

	public function getTickets($id)
	{
		$sql = "";
		$resultado = $this->db->run($sql, array());
		return $resultado;
	}

	public function getWorkedHours()
	{
		$sql = "";
		$resultado = $this->db->run($sql, array());
		return $resultado;
	}

	public function createInvoice()
	{
		$sql = "";
		$resultado = $this->db->run($sql, array());
		return $resultado;
	}

}