<?php

/**
 * DB de conteúdo estático com galeria
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

class Pagina extends Modelo
{

	// adaptador de midia
	private $midia;

	/*
	* construtor
	*
	*
	* @param objeto DB
	*
	* return void
	*/
	public function __construct($db) 
	{
		parent::__construct($db,'paginas','paginaId');
		$this->midia = new AdaptadorMidia($db,'paginas','paginaId');
	}

	
	
	/*
	* 
	* atualiza/modifica capa da pagina
	*
	* 
	* @param $pid int
	* @param $fid int
	*
	* return 
	*/
	public function atualizarCapa($cid,$fid) {
		return $this->midia->atualizarCapa($cid,$fid);
	}
	
	/*
	* 
	* apaga capa da pagina
	*
	* 
	* @param $id int
	*
	* return 
	*/
	public function apagarCapa($id) {
		return $this->midia->apagarCapa($id);
	}
	
	
	/*
	* 
	* mostra capa da pagina
	*
	* 
	* @param $id int
	*
	* return 
	*/
	public function capa($id) {
		return $this->midia->capaCtrl($id);
	}

	/*
	* 
	* mostra x fotos
	*
	* 
	* @param $num int
	*
	* return 
	*/
	public function fotos($num) {
		return $this->midia->fotos($num);
	}

	/*
	* 
	*
	* mostra x galerias
	* 
	* @param $num int
	*
	* return 
	*/
	public function galerias($num) {
		return $this->midia->galerias($num);
	}

	/*
	* 
	* mostra fotos da galeria
	*
	* @param $id int
	* 
	* return void
	*/
	public function fotosGaleria($id)
	{
		return $this->midia->fotosGaleria($id);
	}

	/*
	* 
	* atualiza/modifica galeria da pagina
	*
	* @param $cId int
	* @param $galeriaId int
	*
	* return void
	*/

	public function atualizarGaleria($cId,$galeriaId)
	{
		return $this->midia->atualizarGaleria($cId,$galeriaId);
	}


	/*
	*
	* listar paginas
	*
	* @param porpagina int
	* @param pagina int
	* @param onde string
	* @param ordem array
	* @param ativo bool
	*
	* return void
	*/
	public function listar($porpagina,$pagina,$onde="",$ordem=array('criado','DESC'),$ativo=false) 
	{
		$registros = $this->contar();
		$paginacao = Paginacao::paginar($registros,$porpagina,$pagina);
		
		$dados = $this->db->select(
				$this->tabela,
				$onde,
				array($paginacao->offset,$paginacao->limit),
				$ordem,
				'',
				'*',
				$ativo
		);

		$resultados = array();
		foreach ($dados as $dado) {
			if (!empty($dado['fotoId'])) {
				$dado['fotoPagina'] = $this->midia->fotoCtrl($dado['fotoId']);
			}
			if (!empty($dado['galeriaId'])) {
				$dado['galeriaPagina'] = $this->midia->fotosGaleria($dado['galeriaId']);
			}
			$resultados[] = $dado;
		}

		$this->dados['pgs'] = $paginacao->num_pages;
		$this->dados['conteudo'] = $resultados;
	}



	/*
	*
	*
	*
	* NO MOMENTO, É IDENTICA A FUNCAO ACIMA E NAO TEM UTILIDADE
	*
	*/
	public function listarAdmin($porpagina,$pagina,$onde="",$ordem=array('criado','DESC'),$ativo=false) {
		$registros = $this->contar();
		$paginacao = Paginacao::paginar($registros,$porpagina,$pagina);
		
		$dados = $this->db->select(
				$this->tabela,
				$onde,
				array($paginacao->offset,$paginacao->limit),
				$ordem,
				'',
				'*',
				$ativo
			);

		$resultados = array();
		foreach ($dados as $dado) {
			if (!empty($dado['fotoId'])) {
				$dado['fotoPagina'] = $this->midia->fotoCtrl($dado['fotoId']);
			}
			if (!empty($dado['galeriaId'])) {
				$dado['galeriaPagina'] = $this->midia->fotosGaleria($dado['galeriaId']);
			}
			$resultados[] = $dado;
		}

		$this->dados['pgs'] = $paginacao->num_pages;
		$this->dados['conteudo'] = $resultados;
	}


	/*
	*
	* mostrar pagina
	*
	* @param id int
	* @param ativo bool
	*
	* return void
	*/

	public function mostrar($id, $ativo=false)
	{
		$dados = $this->db->select(
			$this->tabela, 
			$this->getPk() ."=".$id,
			'',
			'',
			'',
			'*',
			$ativo
		);

		$dados = $dados[0];

		if (!empty($dados['fotoId'])) {
			$dados['fotoPagina'] = $this->midia->fotoCtrl(intval($dados['fotoId']));
		}
		if (!empty($dados['galeriaId'])) {
			$dados['galeriaPagina'] = $this->midia->fotosGaleria(intval($dados['galeriaId']));
		}

		$this->dados['conteudo'] = $dados;
	}


	/*
	* 
	* mostra pagina no admin
	*
	* @param id int
	* @param ativo bool
	*
	* return void
	*/

	public function mostrarAdmin($id, $ativo=false) {
		$dados = $this->db->select(
			$this->tabela, 
			$this->getPk() ."=".$id,
			'',
			'',
			'',
			'*',
			$ativo
		);

		$dados = $dados[0];

		if (!empty($dados['fotoId'])) {
			$dados['fotoPagina'] = $this->midia->fotoCtrl(intval($dados['fotoId']));
		}
		if (!empty($dados['galeriaId'])) {
			$dados['galeriaPagina'] = $this->midia->fotosGaleria(intval($dados['galeriaId']));
		}

		$this->dados['fotos'] = $this->midia->fotos(100);
		$this->dados['galerias'] = $this->midia->galerias(100);

		$this->dados['conteudo'] = $dados;
	}

}



?>
