<?php

/**
 * db de usuario com senha para autenticação
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

class Usuario extends Modelo
{
	/*
	*
	* construtor
	*
	* @param $db DB
	* 
	* return void
	*
	*/

	public function __construct($db) 
	{
		parent::__construct($db,'usuarios','usuarioId');
	}


	/*
	*
	* insere novo usuario
	*
	* @param $post array
	*
	* return void
	*/

	public function inserir($post)
	{
		if (isset($post['senha']) && $post['senha'] == '') {
			unset($post['senha']);
		} elseif (isset($post['senha']) && $post['senha'] != ''){
			$post['senha'] = md5($post['senha']);
		}
		$dados = $this->db->insert($this->tabela,$post);
		$this->dados['conteudo'] = $dados;
	}

	/*
	*
	* modifica usuario
	*
	* @param $post array
	* @param $id int
	*
	* return void
	*/

	public function modificar($post,$id)
	{
		
		if (isset($post['senha']) && $post['senha'] == '') {
			// se o campo da senha esta vazio, nao atualizar
			unset($post['senha']);
		} elseif (isset($post['senha']) && $post['senha'] != ''){
			// se nao esta vazio, criptografar senha
			$post['senha'] = md5($post['senha']);
		}
		$dados = $this->db->update($this->tabela,$post,"usuarioId=".$id);
		$this->dados['conteudo'] = $dados;
	}


	/*
	*
	* modifica permissao de usuario
	*
	* @param $id int
	* @param $tipo int
	*
	* return void
	*
	*/
	public function modificarPermissao($id,$tipo) 
	{
		$sql = "UPDATE SET tipo=:tipo WHERE usuarioId=$id";
		$dados = $this->db->update($this->tabela,array('tipo'=> $tipo),"usuarioId=".$id);
		$this->dados['conteudo'] = $dados;
	}

		
}

?>
