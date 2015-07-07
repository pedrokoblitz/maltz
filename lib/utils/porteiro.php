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



class Porteiro
{
	private static $usuario;
	private static $nivel;

	/*
	* carrega o componente do usuario
	*
	*
	* @param
	*
	* return void
	*/
	public static function carregar(){
		self::$usuario = new Usuario(option('db'));
	}

	/*
	* checa credenciais
	*
	*
	* @param
	*
	* return int
	*/
	public static function credenciais() {
		self::carregar();
		self::$usuario->buscar('username',$_SESSION['usuario']['username']);
		$u = self::$usuario->getDados();
		return $u[0]['tipo'];
	}

	/*
	* realiza autenticacao
	*
	*
	* @param $username string
	* @param $senha string
	*
	* return string / void
	*/
	public static function entrar($username,$senha)
	{
		self::carregar();
		self::$usuario->buscar('username',$username);
		$login = self::$usuario->getDados();
		if ($login['conteudo'][0]['senha'] == md5($_POST['senha'])) {
			$_SESSION['autenticado'] = true;
			unset($login[0]['senha']); 
			$_SESSION['usuario'] = $login['conteudo'][0];
		} else {
			halt('Não autorizado');
		}
	}

	/*
	* encerra sessao
	*
	*
	* @param
	*
	* return void
	*/
	public static function sair()
	{
		session_destroy();   // destroy session data in storage
		session_unset();     // unset $_SESSION variable for the runtime
		redirect_to('index.php/admin');
	}

	/*
	*
	* checa se usuario esta autenticado
	*
	* @param
	*
	* return bool
	*/
	public static function logado()
	{
		if (isset($_SESSION['autenticado']) && $_SESSION['autenticado'] == true) {
			return true;
		}
		return false;
	}

	/*
	*
	* checa permissao e deixa passar ou nao
	*
	* @param $minimo int
	*
	* return bool
	*/
	public static function permitir($minimo)
	{
		if (self::logado()) {
			$privilegio = self::credenciais();
			if ($privilegio >= $minimo) {
				return true;
			}
			return false;
		}
		return false;
	}
}


?>
