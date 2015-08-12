<?php

namespace Maltz\Project\Model;

use Maltz\Mvc\DB;
use Maltz\Mvc\Model;
use Maltz\Mvc\Record;
use Maltz\Mvc\Activity;
use Maltz\Service\Pagination;

class Invoice extends Model
{
    use Activity;

    public function __construct(DB $db)
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
        $result = $this->db->run($sql, $record->toArray());
        return $result;
    }

    public function update(Record $record) {
        throw new \Exception("Invoices cannot be updated. Delete and create a new one.", 001);        
    }

    public function processRecord(Record $record)
    {
        $total = (int) $record->get('totalhours') * (int) $record->get('rate');
        $record->set('total', $total);
        return $record;
    }

    public function show($id)
    {
        if (!(int) $id) {
            throw new \Exception("Id must be integer.", 002);
        }

        $sql = "SELECT t1.id, t2.title AS project, t1.hours, t1.rate, t1.total, t1.activity, t1.created FROM invoices
          JOIN projects t2
            ON t1.project_id=t2.id
          WHERE t1.id=:id";
        $result = $this->db->run($sql, array('id' => $id));
        return $result;
    }

    public function find($pg = 1, $per_page = 12, $key = 'title', $order = 'asc')
    {
        if (!(int) $pg || !(int) $per_page || !is_string($key) || !is_string($order)) {
            throw new \Exception("Page and per_page must be integers, key and order must be strings.", 006);
        }

        $pagination = Pagination::paginate($pg, $per_page);
        $sql = "SELECT t1.id, t2.title AS project, t1.hours, t1.rate, t1.total, t1.activity, t1.created FROM invoices
          JOIN projects t2
            ON t1.project_id=t2.id
          ORDER BY $key $order
          LIMIT $pagination->offset, $pagination->limit";
        $result = $this->db->run($sql);
        return $result;
    }

    public function setSent($id)
    {
        if (!(int) $id) {
            throw new \Exception("Id must be integer.", 003);
        }

        $this->setActivity($id, 2);
    }

    public function setContested($id)
    {
        if (!(int) $id) {
            throw new \Exception("Id must be integer.", 004);
        }

        $this->setActivity($id, 3);
    }

    public function setPaid($id)
    {
        if (!(int) $id) {
            throw new \Exception("Id must be integer.", 005);
        }

        $this->setActivity($id, 4);
    }
}
