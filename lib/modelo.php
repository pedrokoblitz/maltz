<?php

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
 * @package    Meu CMS ainda não tem nome
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


abstract class Modelo
{
	// PROPRIEDADES

	protected $db;
	protected $tabela;
	protected $dados;
	protected $pk;

	// forca as classe filhas a implementarem esses mÃ©todos
	//	abstract public function purificar($post);
	//	abstract public function inserir($estrutura);
	/*
	 * ordena os resultados com base na chave 
	 * 
	 * @param array array
	 * @param key string
	 * 
	 * return array
	 * 
	 */

	protected function ordenar($array, $key) {
		$sorter=array();
		$ret=array();
		reset($array);
		foreach ($array as $ii => $va) {
			$sorter[$ii]=$va[$key];
		}
		asort($sorter);
		foreach ($sorter as $ii => $va) {
			$ret[$ii]=$array[$ii];
		}
		return $ret;
	}

	/*
	*
	* CONSTRUTOR
	*
	* @param db objeto DB
	* @param tabela string
	* return void
	*/
	public function __construct($db,$tabela,$pk) 
	{
		$this->db = $db;
		$this->tabela = $tabela;
		$this->pk = $pk;
		$this->dados['info']['identificador'] = $pk; 
		$this->dados['info']['nome'] = $tabela; 
		$this->dados['info']['apelido'] = str_replace('Id','',$pk); 
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
	* nome da tabela
	*
	* @param 
	*
	* return string
	*/
	protected function getTabela()
	{
		return $this->tabela;
	}

	/*
	*
	*
	*
	* 
	*
	* return chave primaria
	*/
	protected function getPk()
	{
		return $this->pk;
	}

	/*
	* lista os registros
	* guarda resultado na var $dados
	*
	* @param int
	* @param int
	*
	* return void
	*/
	public function listar($porpagina,$pagina,$onde="",$ordem=array('criado','DESC'),$ativo=false)
	{
		$registros = $this->contar();
		$paginacao = Paginacao::paginar($registros,$porpagina,$pagina);

		$this->dados['conteudo'] = $this->db->select(
				$this->tabela,
				$onde,
				array($paginacao->offset,$paginacao->limit),
				$ordem,
				'',
				'*',
				$ativo
			);
 		$this->dados['pgs'] = $paginacao->num_pages;
	}

	/*
	*
	* modifica um registro identificado por id
	* guarda resultado na var $dados
	*
	* @param array
	* @param int
	*
	* return void
	*/
	public function modificar($post,$id)
	{
		$this->db->update($this->tabela,$post,$this->pk ."=".$id);
		$this->dados['conteudo'] = $id;
	}


	/*
	*
	* insere um novo registro
	* guarda resultado na var $dados
	*
	* @param array
	*
	* return void
	*/
	public function inserir($dados='')
	{
		$resultado = $this->db->insert($this->tabela,$dados);
		$this->dados['conteudo'] = $resultado;
	}


	/*
	*
	* mostra um registro identificado por id
	* guarda resultado na var $dados
	*
	* @param int
	*
	* return void
	*/
	public function mostrar($id, $ativo=false)
	{
		$dados = $this->db->select(
			$this->tabela,			// tabela
			$this->pk . "=" . $id,	// where
			'',						// limite
			'',						// ordem
			'',						// bind
			'*',					// fields
			$ativo					// ativo
		);
		if (!empty($dados)) $this->dados['conteudo'] = $dados[0];
	}

	/*
	*
	* apaga um registro no banco
	* guarda resultado na var $dados
	*
	* @param int
	*
	* return void
	*/
	public function apagar($id)
	{
		$this->dados = $this->db->delete($this->tabela,$this->pk . "=" . $id);
	}

	/*
	*
	* apenas para tabelas que contem o campo 'ativo'
	* muda valor de ativo para 1
	* guarda resultado na var $dados
	*
	* @param int
	*
	* return void
	*/
	public function ativar($id)
	{
			$this->dados['conteudo'] = $this->db->update($this->tabela,array('ativo' => 1),$this->pk ."=".$id);
	}

	/*
	*
	* apenas para tabelas que contem o campo 'ativo'
	* muda valor de ativo para 0
	* guarda resultado na var $dados
	*
	* @param int
	*
	* return void
	*/
	public function desativar($id)
	{
			$this->dados['conteudo'] = $this->db->update($this->tabela,array('ativo' => 0),$this->pk ."=".$id);
	}

	/*
	*
	* conta numero de registros na tabela
	*
	* @param
	*
	* return int
	*/
	public function contar()
	{	
		$contagem = $this->db->count($this->tabela);
		// reverter para COUNT($this->pk)
		return $contagem[0]["COUNT(*)"];
	}

	/*
	*
	* checa existencia de campo com determinado valor
	*
	* @param string
	* @param mixed
	*
	* return bool
	*/
	public function existe($campo,$valor)
	{
		return $this->db->exists($this->tabela,$campo,$valor);
	}
	

	/*
	*
	* busca valor em determinado campo
	* guarda resultado na var $dados
	*
	* @param string
	* @param mixed
	*
	* return void
	*/
	public function buscar($campo,$valor)
	{
		$this->db;
		$dados = $this->db->search($this->tabela,$campo,$valor);
		$this->dados['conteudo'] = $dados;
	}

	/*
	*
	* 
	*
	* @param
	*
	* return array
	*/
	public function getDado($chave)
	{
		return $this->dados[$chave];
	}

	/*
	*
	* pega o conteudo a ser enviado para o template
	*
	* @param
	*
	* return array
	*/
	public function getDados()
	{
		return $this->dados;
	}

	/*
	*
	* guarda dados em chave especifica
	* utilizado para passar dados para o template que nao sao relativos ao conteudo
	* ex.: numero de paginas para a classe Paginacao
	*
	* @param array
	*
	* return void
	*/
	public function setDado($chave,$valor)
	{
		$this->dados[$chave] = $valor;
	}
	
} /*** fin ***/

?>

