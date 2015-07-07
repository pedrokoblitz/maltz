<?php

/**
 * dá superpoderes de pdfs aos ctrls
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
 
 
class AdaptadorDoc {

	// objeto DB
	private $db;
	// string
	private $tabela;

	/*
	 * 
	 * @param $db objeto DB 
	 * @param $tabela string
	 * @param $pk int
	 * 
	 * return void
	 * 
	 */
	public function __construct($db, $tabela, $pk) {
		$this->db = $db;
		$this->tabela = $tabela;
		$this->pk = $pk;
	}
	
	/*
	 * lista x documentos
	 * 
	 * @param num int
	 * 
	 * return array
	 * 
	 */
	public function listarDocs($num) {
		$sql = "SELECT * FROM arquivos WHERE extensao=\"pdf\" OR extensao=\"PDF\" LIMIT ".$num;
		$docs = $this->db->run($sql);
		return $docs;
	}
	
	/*
	 * atualiza documento do componente
	 * 
	 * @param $id int
	 * @param $cid int
	 * 
	 * return array
	 * 
	 */
	public function atualizarDoc($cid,$id) {
		$sql = "INSERT INTO ".$this->tabela." (docId) values (".$id.") WHERE ".$this->pk."=".$cid.";";
		$doc = $this->db->run($sql);
		return $doc;
	}
	
	/*
	 * mostra documento
	 * 
	 * @param id int
	 *
	 * 
	 * return array
	 * 
	 */
	 
	public function documento($id) {
		$sql = "SELECT * FROM arquivos WHERE arquivoId=:id";
		$doc = $this->db->run($sql,array('id'=>$id));
		return $doc;
	}
	
}
?>
