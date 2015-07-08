<?php

/**
 * Define blocos estáticos para serem guardados no banco
 * e depois aparecerem na barra lateral ou no rodapé de certas pgs
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

class Bloco extends Modelo
{

	/*
	*
	* @param $db DB
	*
	* return void
	*
	*/
	public function __construct($db) 
	{
		parent::__construct($db,'blocos','blocoId');
	}
	
	/*
	*
	* mostra a area
	*
	* @param $area string
	*
	* return void
	*
	*/
	public function mostrarArea($area) 
	{
		$bloco = $this->db->run('SELECT * FROM blocos WHERE area=:area',array('area' => $area));
		if (!empty($bloco)) $this->dados['conteudo'] = $bloco[0];
	}

}
?>
