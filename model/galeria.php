<?php

/**
 * db de galeria pertencente a
 * 	- paginas
 * 	- projetos
 * 	- zines
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
* return void
*/

class Galeria extends Modelo
{
	private $foto;
	private $midia;

	/*
	* construtor
	*
	*
	* @param db objeto DB
	*
	* return void
	*/

	public function __construct($db) 
	{
		parent::__construct($db,'galerias','galeriaId');
		$this->midia = new AdaptadorMidia($db,'galerias','galeriaId');
	}

	/*
	* 
	* mostra fotos da galeria
	*
	* @param id int
	* 
	* return void
	*/
	public function fotosGaleria($id)
	{
		return $this->midia->fotosGaleria($id);
	}
	/*
	* listar galerias
	*
	*
	* @param porpagina int
	* @param pagina int
	* @param onte string
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
			
		$gals = array();
		foreach ($dados as $galeria) {
			$fotos = $this->midia->fotosGaleria($galeria['galeriaId']);
			$galeria['fotos'] = $fotos;
			$gals[] = $galeria;
		}

		$this->dados['conteudo'] = $gals;
		$this->dados['pgs'] = $paginacao->num_pages;
	}

	/*
	* modifica o registro na tabela galerias,
	* reconstroi as relacoes da tabela fotos_galerias
	* e insere novas relacoes.
	*
	* @param array
	* @param int
	*
	* return void
	*/
	public function modificarGaleria($post,$id)
	{
		$fotos = $post['fotosGaleria'];
		unset($post['fotosGaleria']);

		$this->db->delete('fotos_galerias','galeriaId='.$id);
		$this->db->update('galerias',$post,$this->getPk() . "=" . $id);

		foreach ($fotos as $foto) {
			$this->db->insert('fotos_galerias',array('fotoId'=>$foto,'galeriaId'=>$id));
		}

		$this->dados['conteudo'] = $id;
	}


	
	/*
	*
	* seleciona galerias 
	* consulta tabela de relacionamento fotos_galerias
	* e chama todas as fotos da tabela fotos
	*
	* @param int
	*
	* return void ou bool
	*/

	public function mostrar($id, $ativo=false, $admin=true)
	{
		$dados = $this->db->select(
			$this->tabela,
			$this->getPk(). "=" . $id,
			'',
			'',
			'',
			'*',
			$ativo
		);

		$dados = $dados[0];

		$fotos = $this->midia->fotos();
		$fotosGaleria = $this->midia->fotosGaleria($id);

		if ($admin) {
			$this->dados['fotos'] = $fotos;
		}

		$this->dados['fotosGaleria'] = $fotosGaleria;
		$this->dados['conteudo'] = $dados;
	}

}


?>
