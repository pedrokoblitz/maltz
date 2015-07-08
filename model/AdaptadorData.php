<?php

/**
 * descricao aqui
 * 
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012/2013 Pedro Koblitz
 * @author      Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Meu CMS ainda não tem nome
 *
 * @version    0.1 alpha
 */

class AdaptadorData {

	
	/*
	 * converte data para o banco de dados
	 * 
	 * @param $data string
	 *
	 * 
	 * return string
	 * 
	 */
	 
	public static function converterSalvar($data)
	{
		$dataArray = explode('/',$data);
		$dia = $dataArray[0];
		$mes = $dataArray[1];
		$ano = $dataArray[2];
		return $ano."/".$mes."/".$dia;
	}
	
	
	/*
	 * 
	 * converte data para usuario
	 * 
	 * @param $data string
	 * 
	 * 
	 * return string
	 * 
	 */
	 
	public static function converterMostrar($data)
	{
		$dataArray = explode('/',$data);
		$ano = $dataArray[0];
		$mes = $dataArray[1];
		$dia = $dataArray[2];
		return $dia."/".$mes."/".$ano;
	}

}

?>
