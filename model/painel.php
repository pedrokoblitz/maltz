<?php

/**
 * ESSE COMPONENTE NAO ACESSA DIRETAMENTE O BANCO DE DADOS
 * NAO DEVE ESTENDER O CTRL
 * 
 * Utiliza outros ctrls para criar a capa do backend
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

class Painel extends Modelo
{
	
	// objeto DB
	protected $db;

	/*
	*
	* construtor
	* 
	* @param $db
	*
	* 
	*/
	public function __construct($db)
	{
		$this->db = $db;
	}


	/*
	*
	* carrega dados do log
	*
	* @param $num int
	* 
	* return void
	* 
	*/
	public function setLog($num=5)
	{
		$c = new Log($this->db);
		$c->listar($num,1);
		$this->dados['conteudo']['log'] = $c->getDados();
	}

	/*
	*
	* carrega dados das paginas
	*
	* @param $num int
	* 
	* return void
	* 
	*/
	public function setPaginas($num=5)
	{
		$c = new Pagina($this->db);
		$c->listar($num,1);
		$this->dados['conteudo']['paginas'] = $c->getDados();
	}

	/*
	*
	* carrega dados dos zines
	*
	* @param $num int
	* 
	* return void
	* 
	*/
	public function setZines($num=5)
	{
		$c = new Zine($this->db);
		$c->listar($num,1);
		$this->dados['conteudo']['zines'] = $c->getDados();
	}
	

	/*
	*
	* carrega dados dos projetos
	*
	* @param $num int
	* 
	* return void
	* 
	*/
	public function setProjetos($num=5)
	{
		$c = new Projeto($this->db);
		$c->listar($num,1);
		$this->dados['conteudo']['projetos'] = $c->getDados();
	}


	/*
	*
	* carrega dados das galerias
	*
	* @param $num int
	* 
	* return void
	* 
	*/
	public function setGalerias($num=5)
	{
		$c = new Galeria($this->db);
		$c->listar($num,1);
		$this->dados['conteudo']['galerias'] = $c->getDados();
	}


}


?>
