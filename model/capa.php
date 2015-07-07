<?php

/**
 * 
 * 
 * ESSE COMPONENTE NAO ACESSA DIRETAMENTE O BANCO DE DADOS
 * NAO DEVE ESTENDER O CTRL
 * 
 * Utiliza outros ctrls para criar a capa do frontend
 * 
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


class Capa extends Modelo
{
	protected $db;

	/*
	* construtor
	*
	* @param $db DB
	* 
	* return void
	* 
	*/
	public function __construct($db)
	{
		$this->db = $db;
	}

	/*
	*
	* carregar a lista de páginas
	*
	* @param int $n - numero de pgs
	*
	* return void
	* 
	*/
	public function setPaginas($n=5)
	{
		$paginas = new Pagina($this->db);
		$paginas->listar($n,1,'','',true);
		$this->dados['conteudo']['paginas'] = $paginas->getDados();
	}


	/*
	*
	* carregar a lista de projetos
	*
	* @param int $n - numero de pgs
	*
	* return void
	* 
	*/
	public function setProjetos($n=9)
	{
		$projetos = new Projeto($this->db);
		$projetos->listar($n,1,'',array('data', 'DESC'),true);
		$this->dados['conteudo']['projetos'] = $projetos->getDados();
	}
	

	/*
	*
	* carregar a lista de zines
	*
	* @param int $n - numero de pgs
	*
	* return void
	* 
	*/
	public function setZines($n=3)
	{
		$zines = new Zine($this->db);
		$zines->listar($n,1,'',array('data', 'DESC'),true);
		$this->dados['conteudo']['zines'] = $zines->getDados();
	}
	


	/*
	*
	* carregar o rss do tumblr
	*
	* @param int $n - numero de pgs
	*
	* return void
	* 
	*/
	public function setBlog($n=3)
	{
		$rss = new Rss(option('tumblr_rss_url'));
		$rss->getFeed($n);
		$this->dados['conteudo']['blog'] = $rss->getDados();
	}


	/*
	*
	* carregar as galerias
	* (depreciado)
	* 
	* return void
	* 
	*/
	public function setGalerias($n=5)
	{
		$galerias = new Galeria($this->db);
		$galerias->listar($n,1,$ativo=true);
		$this->dados['conteudo']['galerias'] = $galerias->getDados();
	}

}

?>
