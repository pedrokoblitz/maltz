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
        $this->db = $db;
        $this->table = $table;
        $this->fk = $fk;
        $this->identifier = $id;
    }

    // forca as classe filhas a implementarem esses mÃ©todos
    //	abstract public function purificar($post);
    //	abstract public function insert($estrutura);
    /*
	 * ordena os resultados com base na key
	 *
	 * @param array array
	 * @param key string
	 *
	 * return array
	 *
	 */

    protected function sort($array, $key)
    {

        $sorter = array();
        $ret = array();
        reset($array);

        foreach ($array as $ii => $va) {
            $sorter[$ii] = $va[$key];
        }

        asort($sorter);

        foreach ($sorter as $ii => $va) {
            $ret[$ii] = $array[$ii];
        }

        return $ret;
    }

    /*
	 *
	 * name da table
	 *
	 * @param
	 *
	 * return string
	 */
    protected function getTable()
    {
        return $this->table;
    }

    /*
	 *
	 *
	 *
	 *
	 *
	 * return key primaria
	 */
    protected function getFk()
    {
        return $this->fk;
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
    public function update($data, $id)
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
    public function insert($data = null)
    {
        if (!$data) {
            $data = array();
        }

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

    /*
	 *
	 * apenas para tables que contem o campo 'activity'
	 * muda value de activity para 1
	 * guarda resultado na var $data
	 *
	 * @param int
	 *
	 * return void
	 */
    public function activate($id)
    {
        return $this->db->update($this->table, array('activity' => 1), $this->identifier . "=" . $id);
    }

    /*
	 *
	 * apenas para tables que contem o campo 'activity'
	 * muda value de activity para 0
	 * guarda resultado na var $data
	 *
	 * @param int
	 *
	 * return void
	 */
    public function deactivate($id)
    {
        return $this->db->update($this->table, array('activity' => 0), $this->identifier . "=" . $id);
    }

    /*
	 *
	 * conta numero de registros na table
	 *
	 * @param
	 *
	 * return int
	 */
    public function count()
    {
        $contagem = $this->db->count($this->table);
        $num = $contagem[0]["COUNT(id)"];
        return $num;
    }

    /*
	 *
	 * checa existencia de campo com determinado value
	 *
	 * @param string
	 * @param mixed
	 *
	 * return bool
	 */
    public function exists($campo, $value)
    {
        $exists = $this->db->exists($this->table, $campo, $value);
        return $exists;
    }

    /*
	 *
	 * search value em determinado campo
	 * guarda resultado na var $data
	 *
	 * @param string
	 * @param mixed
	 *
	 * return void
	 */
    public function search($campo, $value)
    {
        $this->db;
        $result = $this->db->search($this->table, $campo, $value);
        return $result;
    }
}
