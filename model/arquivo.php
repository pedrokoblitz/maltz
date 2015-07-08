<?php

/**
 * db de arquivos pertencentes a galerias
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

class Arquivo extends Modelo
{
	private $galeria;

	/*
	* construtor
	*
	* @param db objeto DB
	*
	*
	*/
	public function __construct($db) 
	{
		parent::__construct($db,'arquivos','arquivoId');
	}

	/*
	*
	* apaga um registro no banco
	* guarda resultado na var $dados
	*
	* @param id int
	*
	* return void
	*/
	public function apagar($id)
	{
		$arquivo = $this->db->select($this->tabela,$this->pk . "=" . $id);
		$this->db->delete($this->tabela,$this->pk . "=" . $id);
		$this->db->delete('fotos_galerias',$this->pk . "=" . $id);
		return $arquivo[0];
		
	}


	/*
	* inserer arquivo E adiciona em galeria
	*
	* @param $post - dados da arquivo
	* @param $galeriaId - identificador da galeria
	*
	* return bool
	*
	*/
	public function inserirFotoGaleria($post,$galeriaId) 
	{
		$this->inserir($post);
		$arquivoId = $this->getDados();
		return $this->db->insert('fotos_galerias',array('arquivoId'=>$arquivoId['conteudo'],'galeriaId'=>$galeriaId));
	}


	/*
	* associa arquivo a uma galeria
	*
	* @param $arquivoId int
	* @param $galeriaId int
	* 
	* return bool
	*
	*/
	public function assocFotoGaleria($arquivoId,$galeriaId) 
	{
		if (!$this->db->select('fotos_galerias',"fotoId=$arquivoId AND galeriaId=$galeriaId")) {
			return $this->db->insert('fotos_galerias',array('fotoId'=>$arquivoId,'galeriaId'=>$galeriaId));
		}
	}



	/*
	* retira arquivo da galeria
	* 
	* @param $arquivoId int
	* @param $galeriaId int
	*
	* return bool
	*
	*/
	public function deleteFotoGaleria($arquivoId,$galeriaId) 
	{
		return $this->db->delete('fotos_galerias',"fotoId=$arquivoId AND galeriaId=$galeriaId");
	}

	/*
	* busca arquivos pelo nome
	*
	* @param $nome string 
	*
	* return array
	*
	*/
	public function porNome($nome)
	{
		$sql = "SELECT * FROM arquivos WHERE nome=:nome;";
		$this->dados['conteudo'] = $this->db->run($sql,array('nome'=>$nome));
	}

	/*
	* busca arquivos pela extensao
	*
	* @param $ext string
	*
	* return array
	*
	*/
	public function porExt($ext)
	{
		$sql = "SELECT * FROM arquivos WHERE extensao=:ext;";
		$this->dados['conteudo'] = $this->db->run($sql,array('ext'=>$ext));
	}


}



?>
