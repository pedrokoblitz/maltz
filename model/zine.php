<?php

/**
 * db de conteúdo dinâmico com galeria
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

class Zine extends Modelo
{


	// adaptador midia
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
		parent::__construct($db,'zines','zineId');
		$this->midia = new AdaptadorMidia($db,'zines','zineId');
	}
	
	
	/*
	* 
	*
	* atualiza/modifica capa do zine
	* 
	* @param $pid
	* @param $fid
	*
	* return 
	*/
	public function atualizarCapa($cid,$fid) {
		return $this->midia->atualizarCapa($cid,$fid);
	}

	/*
	* 
	*
	* retorna capa do zine
	* 
	* @param $id
	*
	* return array
	*/
	public function capa($id) {
		return $this->midia->capaCtrl($id);
	}
	
	/*
	* 
	* apaga capa do zine
	*
	* 
	* @param $id
	*
	* return 
	*/
	public function apagarCapa($id) {
		return $this->midia->apagarCapa($id);
	}
	
	/*
	* 
	* retorna lista de x fotos
	*
	* 
	* @param $num
	*
	* return fotos
	*/
	public function fotos($num=null) {
		return $this->midia->fotos($num);
	}

	/*
	* 
	* retorna a lista de x galerias
	*
	* 
	* @param $num
	*
	* return 
	*/
	public function galerias($num=null) {
		return $this->midia->galerias($num);
	}

	/*
	* 
	*
	* retorna fotos da galeria
	* 
	* return 
	*/
	public function fotosGaleria($id)
	{
		return $this->midia->fotosGaleria($id);
	}

	/*
	* 
	* atualiza galeria do zine
	*
	* @param $cId
	* @param $galeriaId
	*
	* return
	*/

	public function atualizarGaleria($cId,$galeriaId)
	{
		return $this->midia->atualizarGaleria($cId,$galeriaId);
	}


	/*
	* 
	* lista zines no admin
	*
	* @param $porpagina
	* @param $pagina
	* @param $onde
	* @param $ordem
	* @param $ativo
	*
	* return
	*/
	public function listarAdmin($porpagina,$pagina,$onde="",$ordem=array('data','DESC'),$ativo=false) 
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
				$dado['fotoZine'] = $this->midia->fotoCtrl($dado['fotoId']);
			}
			if (!empty($dado['galeriaId'])) {
				$dado['galeriaZine'] = $this->midia->fotosGaleria($dado['galeriaId']);
			}
			if (!empty($dado['capaId'])) {
				$dado['capaZine'] = $this->capa($dado['capaId']);
			}
			$resultados[] = $dado;
		}
		$this->dados['conteudo'] = $resultados;
		$this->dados['pgs'] = $paginacao->num_pages;
	}


	/*
	* lista zines
	*
	* @param $porpagina
	* @param $pagina
	* @param $onde
	* @param $ordem
	* @param $ativo
	* 
	* return array
	*
	*/
	public function listar($porpagina,$pagina,$onde="",$ordem=array('data','DESC'),$ativo=false) 
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
				$dado['fotoZine'] = $this->midia->fotoCtrl($dado['fotoId']);
			}
			if (!empty($dado['galeriaId'])) {
				$dado['galeriaZine'] = $this->midia->fotosGaleria($dado['galeriaId']);
			}
			if (!empty($dado['capaId'])) {
				$dado['capaZine'] = $this->capa($dado['capaId']);
			}
			$resultados[] = $dado;
		}
		$this->dados['conteudo'] = $resultados;
		$this->dados['pgs'] = $paginacao->num_pages;
	}

	/*
	* 
	* mostra zine
	*
	* @param $id
	* @param $ativo
	* 
	*
	* return
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
			$dados['fotoZine'] = $this->midia->fotoCtrl(intval($dados['fotoId']));
		}
		if (!empty($dados['galeriaId'])) {
			$dados['galeriaZine'] = $this->midia->fotosGaleria(intval($dados['galeriaId']));
		}
		if (!empty($dados['capaId'])) {
			$dados['capaZine'] = $this->capa($dados['capaId']);
		}


		$this->dados['conteudo'] = $dados;
	}



	/*
	* 
	* mostra zine no admin
	*
	* @param $id
	* @param $ativo
	*
	* return
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
		if (!empty($dados['data'])) {
			$dados['data'] = AdaptadorData::converterMostrar($dados['data']);
		}


		if (!empty($dados['fotoId'])) {
			$dados['fotoZine'] = $this->midia->fotoCtrl(intval($dados['fotoId']));
		}
		
		if (!empty($dados['galeriaId'])) {
			$dados['galeriaZine'] = $this->midia->fotosGaleria(intval($dados['galeriaId']));
		}
		if (!empty($dados['capaId'])) {
			$dados['capaZine'] = $this->capa($dados['capaId']);
		}


		$this->dados['fotos']= $this->fotos();
		$this->dados['galerias'] = $this->galerias();

		$this->dados['conteudo'] = $dados;
	}
	/*
	* 
	* modifica zine
	*
	* @param $dados
	* @param $id
	* 
	* return void
	*/
	
	public function modificar($dados,$id) {
		if (!empty($dados['data'])) {
			$dados['data'] = AdaptadorData::converterSalvar($dados['data']);
		}
		return parent::modificar($dados,$id);
	}

}

?>
