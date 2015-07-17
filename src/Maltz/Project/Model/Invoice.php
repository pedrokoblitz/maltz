<?php

namespace Maltz\Project\Model;

use Maltz\Mvc\Record;
use Maltz\Service\Pagination;

class Invoice
{
    public function __construct($db)
    {
        $rules = array(
            'id' => 'int',
            'project_id' => 'int',
            'hours' => 'int',
            'rate' => 'float',
            'total' => 'float',
            'activity' => 'int',
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
        if (!is_int($id)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $sql = "SELECT t1.id, t2.title AS project, t1.hours, t1.rate, t1.total, t1.activity, t1.created FROM invoices
          JOIN projects t2
            ON t1.project_id=t2.id
          WHERE t1.id=:id";
        $resultado = $this->db->run($sql, array('id' => $id));
        return $resultado;
    }

    public function find($pg = 1, $per_page = 12, $key = 'title', $order = 'asc')
    {
        if (!is_int($pg) || !is_int($per_page) || !is_string($key) || !is_string($order)) {
            throw new \Exception("Error Processing Request", 1);
        }

        $pagination = Pagination::paginate($pg, $per_page);
        $sql = "SELECT t1.id, t2.title AS project, t1.hours, t1.rate, t1.total, t1.activity, t1.created FROM invoices
          JOIN projects t2
            ON t1.project_id=t2.id
          ORDER BY $key $order
          LIMIT $pagination->offset, $pagination->limit";
        $resultado = $this->db->run($sql);
        return $resultado;
    }

    public function setSent($id)
    {
        $this->setActivity($id, 2);
    }

    public function setContested($id)
    {
        $this->setActivity($id, 3);
    }

    public function setPaid($id)
    {
        $this->setActivity($id, 4);
    }
}
