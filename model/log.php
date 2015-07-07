<?php

/**
 * db de relatório de atividade
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
class Log extends Modelo
{

	/*
	*
	* construtor 
	* 
	* @param db objeto DB
	*
	*/
	public function __construct($db) 
	{
		parent::__construct($db,'log','logId');
	}

}
?>
