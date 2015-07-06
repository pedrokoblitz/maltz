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
    protected $data = array();

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

        $this->set('info.identifier', $id);
        $this->set('info.slug', $slug);
        $this->set('info.table', $table);
        $this->set('info.fk', $fk);
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
	 * objeto DB
	 *
	 *
	 *
	 * return objeto DB
	 */
    protected function getDb()
    {
        return $this->db;
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
	 * list os registros
	 * guarda resultado na var $data
	 *
	 * @param int
	 * @param int
	 *
	 * return void
	 */
    public function index($perpage = 12, $page = 1, $where = "", $order = null, $activity = false)
    {
        if (!$order) {
            $order = array('created', 'DESC');
        }

        $pagination = Pagination::pager($this->count(), $perpage, $page);

        $data = $this->db->select(
            $this->table,
            $where,
            array($pagination->offset, $pagination->limit),
            $order,
            '',
            '*',
            $activity
        );
        
        if (!$data) {
            return false;
        }

        $this->data['data.list'] = $data;
        $this->data['pagination.pages'] = $pagination->num_pages;

        return true;
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
        $this->data['meta.insert'] = $resultado;
        
        if (!$resultado) {
            return false;
        }
        return $resultado;
    }

    /*
	 *
	 * mostra um registro identificado por id
	 * guarda resultado na var $data
	 *
	 * @param int
	 *
	 * return void
	 */
    public function show($id, $activity = false)
    {
        $data = $this->db->select(
            $this->table, // table
            $this->identifier . "=" . $id, // where
            '', // limite
            '', // order
            '', // bind
            '*', // fields
            $activity // activity
        );
        if (!empty($data)) {
            $this->data['data.record'] = $data[0];
            return true;
        }
        return false;
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
        $this->data['meta.count'] = $num;
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
        $this->data['meta.exists'] = $exists;
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
        $data = $this->db->search($this->table, $campo, $value);
        if (!$data) {
            return false;
        }
        $this->data['data.search'] = $data;
        return true;
    }

    /*
	 *
	 *
	 *
	 * @param
	 *
	 * return array
	 */
    public function get($key)
    {
        return $this->data[$key];
    }

    /*
	 *
	 * pega o data.content a ser enviado para o template
	 *
	 * @param
	 *
	 * return array
	 */
    public function all()
    {
        return $this->data;
    }

    /*
	 *
	 * guarda data em key especifica
	 * utilizado para passar data para o template que nao sao relactivitys ao data.content
	 * ex.: numero de pages para a classe Pagination
	 *
	 * @param array
	 *
	 * return void
	 */
    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }
}
