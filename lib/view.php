<?php

/**
 * CONVENCOES DO View
 * as funcoes set(), js(), json() e css() sao parte da biblioteca limonade-php
 * http://limonade-php.net (ver pÃ¡gina do README para detalhes)
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

/* é assim que se implementam os includes...
    ob_start();
    extract($vars);
    include $view_path;
    $content = ob_get_clean();
*/

/*
*
*
*
* @param objeto DB
* 
* 
*/


class View
{
	// PROPRIEDADES
	protected $view;
	protected $layout;

	// forca as classe filhas a implementarem esses mÃ©todos
	//	abstract public function purificar($post);
	//	abstract public function inserir($estrutura);

	public function __construct($layout='',$view='')
	{
		$this->layout = $layout;
		$this->view = $view;
	}

	/*
	*
	*  diz qual layout serÃ¡ usado para render
	*
	* @param string
	*
	* return void
	*/
	public function setLayout($layout)
	{
		$this->layout = $layout;
	}

	/*
	*
	* passa o template a ser utilizado no render
	*
	* @param string
	*
	* return void
	*/
	public function setView($view)
	{
		$this->view = $view;
	}

	/*
	*
	* pega nome do template sendo utilizado
	*
	* @param
	*
	* return string
	*/
	public function getView()
	{
		return $this->view;
	}

	/*
	*
	* pega nome do layout sendo utilizado
	*
	* @param
	*
	* return string
	*/
	public function getLayout()
	{
		return $this->layout;
	}

	/*
	* passa os dados template html usando metodos do limonade-php
	* junta dados com template e layout
	* devolve HTML
	*
	* @param 
	*
	* return string
	*/
	public function render($dados)
	{		
		foreach ($dados as $c => $v) {
			set($c,$v);
		}
		$t = new TplHelper();
		set('t',$t);

		return html($this->view,$this->layout);
	}
	
	/*
	*
	* transforma dados em JSON
	* passa os dados para json usando metodo do limonade-php
	*
	* @param
	*
	* return string
	*/
	public function renderJSON($dados)
	{
		return json_encode($dados);
	}
	
} /*** fin ***/

?>

