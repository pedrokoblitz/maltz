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
    // PROPRIEDADES

    protected $db;
    protected $table;
    protected $fk;
    protected $identifier;

    /*
	 *
	 * CONSTRUTOR
	 *
	 * @param db objeto DB
	 * @param table string
	 * return void
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
	 * name da table
	 *
	 * @param
	 *
	 * return string
	 */
    protected function __get($key)
    {
        return is_string($key) && isset($this->$key) && in_array($key, array('slug', 'table', 'fk')) ? $this->$key : null;
    }

    /*
	 *
	 * modifica um registro identificado por id
	 * guarda resultado na var $data
	 *
	 * @param array
	 * @param int
	 *
	 * return void
	 */
    public function update(array $data, $id)
    {
        return $this->db->update($this->table, $data, $this->identifier . "=" . $id);
    }

    /*
	 *
	 * insere um new registro
	 * guarda resultado na var $data
	 *
	 * @param array
	 *
	 * return void
	 */
    public function insert(array $data)
    {
        $resultado = $this->db->insert($this->table, $data);
        return $resultado;
    }

    /*
	 *
	 * apaga um registro no banco
	 * guarda resultado na var $data
	 *
	 * @param int
	 *
	 * return void
	 */
    public function delete($id)
    {
        return $this->db->delete($this->table, $this->identifier . "=" . $id);
    }

    public static function query($db, $action, $params)
    {
        $model = new static($db);
        return call_user_method_array($action, $model, $params);
    }
}
