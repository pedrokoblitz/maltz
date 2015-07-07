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


/**
* Adaptado por Pedro Koblitz
* Classe Para validação da Dados
* @author David CHC
* @version 0.1
*
*/
class Purificador {


	/**
	 * Método que executa a regexp
	 * 
	 * @param $expressao string
	 * @param $dado mixed
	 * 
	 * @return bool
	 */
	private function validar($expressao, $dado) {
	    $match = preg_match($expressao, $dado);
		if ($match) {
			return true;
		}
		return false;
	}


	/**
	 * Método que verifica se é numero
	 * 
	 * @param $dado mixed
	 * 
	 * @return bool
	 */
	public static function numero($dado) {
		return self::validar("/^[0-9]$/",$dado);
	}

	/**
	 * Método que verifica se é numero real
	 * 
	 * @param $dado mixed
	 * 
	 * @return bool
	 */
	public static function numeroReal($dado) {
		return self::validar("/^[0-9]+?(.|,[0-9]+)$/",$dado);
	}

	/**
	 * Método que verifica se é numero e/ou letras
	 * 
	 * @param $dado mixed
	 * 
	 * @return bool
	 */
	public static function alfanumerico($dado) {
		return self::validar("/^[a-zA-Z0-9]$/",$dado);
	}


	/**
	 * Método que verifica se o email é válido
	 * 
	 * @param $dado mixed
	 * 
	 * @return bool
	 */
	public static function email($dado) {
		if (filter_var($dado, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}

	/**
	 * Método que verifica se a data esta no formato dd-mm-YYYY
	 * 
	 * @param $dado mixed
	 * 
	 * @return bool
	 */
	public static function data($dado) {
		return self::validar("/^[0-9]{2}\-[0-9]{2}\-[0-9]{4}$/",$dado);
	}

	/**
	 * Método que verifica se url é valida
	 * 
	 * @param $dado mixed
	 * 
	 * @return bool
	 */
	public static function url($dado) {
		return self::validar("/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/",$dado);
	}

	/**
	 * Método que verifica se o telefone está no formato 99-9999-9999
	 * 
	 * @param $dado mixed
	 * 
	 * @return bool
	 */
	public static function telefone($dado) {
	    //(99)9999-9999
		return self::validar("/^[0-9]{2}-[0-9]{4}-[0-9]{4}$/",$dado);
	}


	/**
	 * Método que verifica
	 * 
	 * @param $dado mixed
	 * 
	 * @return bool
	 */
	public static function cnpj($dado) {
		return self::validar("/^\d{3}.?\d{3}.?\d{3}/?\d{3}-?\d{2}$/",$dado);
	}


	/**
	 * Método que verifica
	 * 
	 * @param $dado mixed
	 * 
	 * @return bool
	 */
	public static function cpf($dado) {
		return self::validar("/^\d{3}\.?\d{3}\.?\d{3}\-?\d{2}$/",$dado);
	}

	/**
	 * Método que verifica
	 * 
	 * @param $dado mixed
	 * 
	 * @return bool
	 */
	public static function cep($dado) {
		return self::validar("^\d{5}\-?\d{3}$",$dado);
	}

	/**
	 * Método que verifica
	 * 
	 * @param $dado mixed
	 * 
	 * @return bool
	public static function endereco($dado) {
		return self::validar("",$dado);
	}
	 */


}


?>
