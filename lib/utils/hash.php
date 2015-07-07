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

class PassHash {

	// blowfish
	private static $algo = '$2a';

	// cost parameter
	private static $cost = '$10';

	// mainly for internal use
	public static function unique_salt() {
		return substr(sha1(mt_rand()),0,22);
	}

	/*
	* this will be used to generate a hash
	*
	*
	* @param $password string
	*
	* return string
	*/
	public static function hash($password) {

		return crypt($password,
					self::$algo .
					self::$cost .
					'$' . self::unique_salt());

	}

	/*
	* this will be used to compare a password against a hash
	*
	*
	* @param $hash string
	* @param $password string
	*
	* return string
	*/
	public static function check_password($hash, $password) {

		$full_salt = substr($hash, 0, 29);

		$new_hash = crypt($password, $full_salt);

		return ($hash == $new_hash);

	}

}

?>
