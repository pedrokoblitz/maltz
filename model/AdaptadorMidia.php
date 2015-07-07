<?php

/**
 * dá superpoderes multimídia aos ctrls
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

class AdaptadorMidia {
	
	// objeto DB
	private $db;
	// string
	private $tabela;
	// int
	private $pk;

	/*
	* 
	*
	* @param $db
	* @param $tabela
	*
	* return void
	*/
	public function __construct($db,$tabela,$pk) {
		$this->db = $db;
		$this->tabela = $tabela;
		$this->pk = $pk;
	}

	/*
	 * ordena os resultados com base na chave 
	 * 
	 * @param array array
	 * @param key string
	 * 
	 * return array
	 * 
	 */

	private function ordenar($array, $key) {
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
	* atualiza galeria do componente
	*
	* @param $cId int
	* @param $galeriaId int
	*
	* return array
	*/
	public function atualizarGaleria($cId,$galeriaId)
	{
		if (intval($galeriaId) && intval($cId)) {
			$sql = "UPDATE ".$this->tabela." SET galeriaId=:gId WHERE ".$this->pk."=:pId";
			$bind = array('pId'=>$cId,'gId'=>$galeriaId);
			$r = $this->db->run($sql,$bind);
			return $r;
		}
	}


	/*
	* 
	* atualiza capa do componente
	*
	* @param $cId
	* @param $fotoId
	*
	* return void
	*/
	public function atualizarCapa($cId,$fotoId)
	{
		if (intval($fotoId) && intval($cId)) {
			$sql = "UPDATE ".$this->tabela." SET capaId=:gId WHERE ".$this->pk."=:pId";
			$bind = array('pId'=>$cId,'gId'=>$fotoId);
			$r = $this->db->run($sql,$bind);
			return $r;
		}
	}



	/*
	* 
	* apaga capa do componente
	*
	* @param $cId
	* @param $fotoId
	*
	* return void
	*/
	public function apagarCapa($cId)
	{
		if (intval($fotoId) && intval($cId)) {
			$sql = "UPDATE ".$this->tabela." SET capaId=0";
			$r = $this->db->run($sql);
			return $r;
		}
	}
	/*
	* 
	* lista x fotos
	*
	* @param $num int
	*
	* return void
	*/

	public function fotos($num=null) 
	{
		$sql = "SELECT * FROM arquivos WHERE extensao!=\"pdf\" AND extensao!=\"PDF\"";
		if ($num && intval($num)) {
			$sql .= " LIMIT ".$num;
		}
		$imgs = $this->db->run($sql);
		return $imgs;
	}

	/*
	* 
	* mostra capa do componente
	*
	* @param $id int
	*
	* return void
	*/

	public function capaCtrl($id) 
	{
		$dados = $this->db->select('arquivos','arquivoId='.$id);
		return (isset($dados[0])) ? $dados[0] : $dados;
	}



	/*
	* 
	* mostra fotos da galeria
	*
	* @param $id int id da galeria
	*
	* return void
	*/

	public function fotosGaleria($id) 
	{
		$sql = "SELECT a.arquivoId, a.titulo, a.nome, a.extensao, fg.ordem FROM arquivos a INNER JOIN fotos_galerias fg ON a.arquivoId = fg.fotoId INNER JOIN galerias g ON fg.galeriaId = g.galeriaId where g.galeriaId = ".$id;
		$r = $this->db->run($sql);
		
		// onde vai o $gal?
		$gal = array();
		foreach	($r as $i) {
			$gal[]['titulo'] = $i['titulo'];
			$gal[]['nome'] = $i['nome'];
			$gal[]['extensao'] = $i['extensao'];
			$gal[]['ordem'] = $i['ordem'];
		}
//		var_dump($r);
//		var_dump($gal);
		$ordenada = $this->ordenar($r,'ordem');
		return $ordenada;
	}

	/*
	* chama todas as galerias
	* para serem listadas no gerenciador de midia
	*
	* @param $num int
	* 
	* return array
	*/

	public function galerias($num = null)
	{ 
		$sql = "SELECT * FROM galerias";
		if ($num && intval($num)) {
			$sql .= " LIMIT ".$num;
		}
		$dados = $this->db->run($sql);

		$resultados = array();
		foreach ($dados as $galeria) {
			$galeria['fotos'] = $this->fotosGaleria($galeria['galeriaId']);
			$resultados[] = $galeria;
		}
		return $resultados;
	}
	
}
?>
