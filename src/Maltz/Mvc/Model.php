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

    protected $identifier;

    /*
	 *
	 */
    public function __construct($db, $slug, $table, $fk = null, $id = 'id')
    {
        if (!$fk && $id === 'id') {
            $fk = $slug . '_' . $id;
        }
        $this->slug = $slug;
        $this->db = $db;
        $this->table = $table;
        $this->fk = $fk;
        $this->identifier = $id;
    }

    /*
	 *
	 */
    protected function __get($key)
    {
        return is_string($key) && isset($this->$key) && in_array($key, array('slug', 'table', 'fk')) ? $this->$key : null;
    }

    /*
     *
     */
    public static function query(Query $query)
    {
        $model = new static($query->db);
        return call_user_method_array($query->action, $model, $query->params);
    }
}
