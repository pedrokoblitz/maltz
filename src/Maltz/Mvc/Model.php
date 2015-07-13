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
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author      Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Maltz
 *
 * @version    0.1 alpha
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
    protected $fk;

    /*
	 *
	 */
    public function __construct($db, $slug, $table, $fk = null)
    {
        if (!$fk && $id === 'id') {
            $fk = $slug . '_' . $id;
        }
        $this->slug = $slug;
        $this->db = $db;
        $this->table = $table;
        $this->fk = $fk;
    }

    /*
	 *
	 */
    protected function __get($key)
    {
        return is_string($key) && isset($this->$key) && in_array($key, array('slug', 'table', 'fk')) ? $this->$key : null;
    }

    public function save(Record $record)
    {
        if ($record->has('id')) {
            return $this->update($record);
        }
        return $this->insert($record);
    }

    /*
     *
     */
    public static function query()
    {
        $args = func_get_args();
        $model = new static($args[0]);
        $params = $args;
        unset($params[0]);
        unset($params[1]);
        $result = call_user_method_array($args[1], $model, array_values($params));
        $result->set('slug', $this->slug);
        return $result;
    }
}
