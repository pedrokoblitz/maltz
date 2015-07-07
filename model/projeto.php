<?php

/**
 * db de conteúdo dinamico com
 * 	- galeria
 * 	- pdf
 * 	- categoria/tipo
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

class Projeto extends Modelo
{
	// adaptador midia
	private $midia;
	// adaptador docs
	private $docs;

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
		parent::__construct($db,'projetos','projetoId');
		$this->midia = new AdaptadorMidia($db,'projetos','projetoId');
		$this->docs = new AdaptadorDoc($db,'projetos','projetoId');
	}
	
	
	
	/*
	* 
	* atualiza capa do projeto
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
	* mostra capa do projeto
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
	* apaga capa do projeto
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
	* lista x fotos
	*
	* 
	* @param $num int
	*
	* return arrau
	*/
	public function fotos($num=null) {
		return $this->midia->fotos($num);
	}

	/*
	* 
	* lista x galerias
	*
	* 
	* @param $num
	*
	* return array
	*/
	public function galerias($num=null) {
		return $this->midia->galerias($num);
	}

	/*
	* 
	* mostra fotos da galeria
	*
	* @param $id int
	* 
	* return array
	*/
	public function fotosGaleria($id)
	{
		$d = $this->midia->fotosGaleria($id);
		return $d;
	}

	/*
	* 
	* atualiza/modifica galeria do projeto
	*
	* @param $cId int
	* @param $galeriaId int
	*
	* return
	*/

	public function atualizarGaleria($cId,$galeriaId)
	{
		return $this->midia->atualizarGaleria($cId,$galeriaId);
	}


	/*
	* 
	* atualiza/modifica documento do projeto
	*
	* @param $cId int
	* @param $pid int
	*
	* return
	*/

	public function atualizarDoc($cId,$pid)
	{
		return $this->docs->atualizarDoc($cId,$pid);
	}


	/*
	* 
	* lista x documentos
	*
	* @param $num int
	*
	* return void
	*/

	public function listarDocs($num)
	{
		return $this->docs->listarDocs($num);
	}

	/*
	* 
	* mostra documento do projeto
	*
	* 
	* @param $id int
	*
	* return 
	*/
	public function documento($id) {
		return $this->docs->documento($id);
	}

	
	/*
	* 
	* lista projetos no admin
	*
	*
	* return void
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
				$dado['fotoProjeto'] = $this->midia->fotoCtrl($dado['fotoId']);
			}

			if (!empty($dado['galeriaId'])) {
				$fotos = $this->midia->fotosGaleria($dado['galeriaId']);
				$dado['galeriaProjeto'] = $fotos;
			}
			if (!empty($dado['capaId'])) {
				$dado['capaProjeto'] = $this->capa($dado['capaId']);
			}
			if (!empty($dado['docId'])) {
				$dado['documentoProjeto'] = $this->documento($dado['docId']);
			}
			$resultados[] = $dado;
		}
		$this->dados['conteudo'] = $resultados;
		$this->dados['pgs'] = $paginacao->num_pages;
	}


	/*
	* 
	* lista projetos
	*
	*
	* return void
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
				$dado['fotoProjeto'] = $this->midia->fotoCtrl($dado['fotoId']);
			}
			if (!empty($dado['galeriaId'])) {
				$fotos = $this->midia->fotosGaleria($dado['galeriaId']);
				$dado['galeriaProjeto'] = $fotos;
			}
			if (!empty($dado['capaId'])) {
				$dado['capaProjeto'] = $this->capa($dado['capaId']);
			}
			$resultados[] = $dado;
		}
		$this->dados['conteudo'] = $resultados;
		$this->dados['pgs'] = $paginacao->num_pages;
	}

	/*
	* 
	* mostra projeto
	*
	* 
	*
	* return void
	*/

	public function mostrar($id, $ativo=false) 
	{
		$dados = $this->db->select(
			$this->tabela, 				// tabela
			$this->getPk() ."=".$id,	// where
			'',							// limite
			'',							// ordem
			'',							// bind
			'*',						// fields
			$ativo						// ativo
		);

		$dados = $dados[0];
		if (!empty($dados['fotoId'])) {
			// se tem foto adiciona aos resultados
			$dados['fotoProjeto'] = $this->midia->fotoCtrl(intval($dados['fotoId']));
		}
		if (!empty($dados['galeriaId'])) {
			// se tem galeria adiciona aos resultados
			$dados['galeriaProjeto'] = $this->fotosGaleria(intval($dados['galeriaId']));
		}
		if (!empty($dados['capaId'])) {
			// se tem capa adiciona aos resultados
			$dados['capaProjeto'] = $this->capa($dados['capaId']);
		}
		if (!empty($dados['docId'])) {
			// se tem adiciona aos resultados
			$dados['documentoProjeto'] = $this->documento($dados['docId']);
		}

		$this->dados['conteudo'] = $dados;
	}

	/*
	* 
	*
	*
	* 
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
		if (!empty($dados['data'])) {
			// se tem adiciona aos resultados
			$dados['data'] = AdaptadorData::converterMostrar($dados['data']);
		}


		if (!empty($dados['fotoId'])) {
			// se tem adiciona aos resultados
			$dados['fotoProjeto'] = $this->midia->fotoCtrl(intval($dados['fotoId']));
		}
		if (!empty($dados['galeriaId'])) {
			// se tem adiciona aos resultados
			$dados['galeriaProjeto'] = $this->fotosGaleria(intval($dados['galeriaId']));
		}
		if (!empty($dados['capaId'])) {
			// se tem adiciona aos resultados
			$dados['capaProjeto'] = $this->capa($dados['capaId']);
		}

		if (!empty($dados['docId'])) {
			// se tem adiciona aos resultados
			$dados['documentoProjeto'] = $this->documento($dados['docId']);
		}


		// isso aqui tem de sair da chave conteudo e ir para o nivel superior
		$dados['docs'] = $this->listarDocs(100);

		$this->dados['fotos'] = $this->fotos();
		$this->dados['galerias'] = $this->galerias();

		$this->dados['conteudo'] = $dados;
	}
	
	/*
	 * modifica projeto 
	 * 
	 * @param $dados array
	 * @param $id int
	 * 
	 * 
	 */

	public function modificar($dados,$id) {
		if (!empty($dados['data'])) {
			$dados['data'] = AdaptadorData::converterSalvar($dados['data']);
		}
		return parent::modificar($dados,$id);
	}

}

?>
