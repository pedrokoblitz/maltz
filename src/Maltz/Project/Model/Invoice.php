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

	public function insert(Record $record)
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

	public function close($id)
	{
		$sql = "";
		$resultado = $this->db->run($sql, array());
		return $resultado;
	}
}