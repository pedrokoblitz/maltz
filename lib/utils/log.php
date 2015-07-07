<?php

/**
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


class LogArquivoHelper {

	private $arquivo;

	/*
	* construtor 
	* 
	* @param $arquivo string
	*
	* return void
	*
	*/
	public function __construct($arquivo) 
	{
		$this->arquivo = $arquivo;
	}

	/*
	* logar msg no arquivo
	* 
	* @param $msg string
	*
	* return void
	*
	*/
	public function log($msg)
	{
		$fh = fopen($this->arquivo, 'a');
		fwrite($fh, $msg."\n");
		fclose($fh);
	}

}


class LogHelper
{

	private static $dados;
	private static $db;

	/*
	* insere no banco
	*
	*
	* @param
	*
	* return void
	*/
	private static function guardar() 
	{
		self::$db->insert('log',self::$dados);
	}

	/*
	* registrar o Log no banco de dados
	*
	*
	* @param $db
	* @param $usuario
	* @param $usuarioId
	* @param $acao
	* @param $nomeComponente
	* @param $id
	*
	* return void
	*/
	public static function registrar($db,$usuario,$usuarioId,$acao,$nomeComponente,$id=null)
	{
		self::$db = $db;
		self::$dados['usuario'] = $usuario;
		self::$dados['usuarioId'] = $usuarioId;
		self::$dados['acao'] = $acao;
		self::$dados['componente'] = $nomeComponente;
		self::$dados['objetoId'] = $id;
		self::$dados['ativo'] = 0;
		self::guardar();
	}
	
}


?>

