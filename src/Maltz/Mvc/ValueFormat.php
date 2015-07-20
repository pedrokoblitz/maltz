<?php

namespace Maltz\Mvc;

trait ValueFormat
{
    protected function formatToInt($format)
    {
        switch ($format) {
        case 'text':
            $bind['format'] = 0;
            break;
        case 'serialized':
            $bind['format'] = 1;
            break;
        case 'json':
            $bind['format'] = 2;
            break;
        case 'xml':
            $bind['format'] = 3;
            break;
        case 'csv':
            $bind['format'] = 4;
            break;
        case 'binary':
            $bind['format'] = 5;
            break;
        default:
            throw new \Exception("Error Processing Request", 1);
                break;
        }
    }

    protected function intToFormat($format)
    {
        switch ($format) {
        case 0:
            $bind['format'] = 'text';
            break;
        case 1:
            $bind['format'] = 'serialized';
            break;
        case 2:
            $bind['format'] = 'json';
            break;
        case 3:
            $bind['format'] = 'xml';
            break;
        case 4:
            $bind['format'] = 'csv';
            break;
        case 5:
            $bind['format'] = 'binary';
            break;
        default:
            throw new \Exception("Error Processing Request", 1);
                break;
        }
    }

    public function setFormat($format, $id)
    {
        if (!is_string($format) || !is_int($id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $sql = "UPDATE $this->table SET format=:format WHERE id=:id";
        $result = $this->db->run($sql, array('format' => $this->formatToInt($format), 'id' => $id));
    }

    public function getFormat($id)
    {
        if (!is_int($id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        
        $sql = "SELECT format FROM $this->table WHERE id=:id";
        $result = $this->db->run($sql, array('id' => $id));
        $format = $result->getFirstRecord()->get('format');
        return $this->intToFormat($format);
    }

    public function formatValue(Record $record)
    {
        $format = $this->getFormat();
        $value = $record->get('value');
        $record->set('value', $this->$format($value));
        return $record;
    }
}
