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

class UrlHelper
{
	private $urls;

	/*
	*
	* construtor
	*
	* @param $urls array
	*
	* return
	*/
	public function __construct($urls) {
		$this->urls = $urls;
		$this->urls['assets'] = '/public/assets/';
		$this->urls['media'] = '/public/media/';
		$this->urls['gwf'] = 'http://fonts.googleapis.com/css?family=';
	}

	/*
	*
	* gera url
	*
	* @param $string string
	* @param $complemento string
	*
	* return
	*/
	public function gen($string, $complemento=null) {
		$url = (isset($this->urls[$string]) ? url_for($this->urls[$string]) : url_for($string)); 
		return ($complemento ? $url .'/'. $complemento : $url);
	}

	/*
	* lida com redirecionamentos nos servicos
	*
	*
	* @param $url string
	* @param $msg string
	*
	* return
	*/
	public static function ajax_redirect($url,$msg="") {
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			die($msg);
		} else {
			$_SESSION['mensagem'] = $msg;
			redirect_to($url);
		}
	}

}


?>
