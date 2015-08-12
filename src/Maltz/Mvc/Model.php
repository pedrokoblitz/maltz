<?php
namespace Maltz\Mvc;

use Maltz\Utils\Pagination;

/**
 * CONVENCOES DO Ctrl
 * as funcoes set(), js(), json() e css() sao parte da biblioteca limonade-php
 * http://limonade-php.net (ver pÃ¡gina do README para detalhes)
 *
 * http://ideiasinsolitas.com.br/
 *
 * @copyright Copyright (c) 2012-2013 Pedro Koblitz
 * @author    Pedro Koblitz pedrokoblitz@gmail.com
 * @license   GPL v2
 *
 * @package Maltz
 *
 * @version 0.1 alpha
 */

/*
 *
 *
 *
 * @param objeto DB
 *
 *
 */

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
                return $this->update($record);
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
            $call = array($model, $method);
            $result = call_user_func_array($call, $params);
            return $result;
        }
        return new Result(
            array(
                'success' => false, 
                'message' => "Method $method does not exists."
                )
            );
    }
}
