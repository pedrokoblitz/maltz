<?php
namespace Maltz\Mvc;

use Maltz\Utils\Pagination;

abstract class Model
{
    protected $db;
    protected $table;
    protected $rules;

    public function __construct($db, $slug, $table, $rules)
    {
        $this->db = $db;
        $this->table = $table;
        $this->slug = $slug;
        $this->rules = $rules;
    }

    public function save(Record $record)
    {
        if (method_exists($this, 'processRecord')) {
            $record = $this->processRecord($record);
        }

        $record->validate($this->rules);
        
        if ($record->isValid()) {
            if ($record->has('id')) {
                if (!method_exists($this, 'update')) {
                    throw new \Exception("Update method is not set", 1);
                }
                return $this->update($record);
            }
            if (!method_exists($this, 'insert')) {
                throw new \Exception("Insert method is not set", 1);
            }
            return $this->insert($record);
        }
        return new Result(array('success' => false, 'message' => 'Invalid record.'));
    }

    public static function query()
    {
        $args = func_get_args();
        $db = $args[0];
        $method = $args[1];
        unset($args[0]);
        unset($args[1]);
        $params = array_values($args);
        $model = new static($db);
        if (method_exists($model, $method)) {
            $result = call_user_method_array($method, $model, $params);
            return $result;
        }
        return new Result(
            array(
                'success' => false,
                'message' => "Method $method does not exist."
            )
        );
    }
}
