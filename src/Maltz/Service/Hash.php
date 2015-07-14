<?php

namespace Maltz\Service;

/**
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author      Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Maltz
 *
 * @version    0.1 alpha
 */
class Hash
{

    public static function hash()
    {
        return md5(microtime());
    }

    /*
	 * this will be used to generate a hash
	 *
	 *
	 * @param $password string
	 *
	 * return string
	 */
    public static function hash($password)
    {
        return sha1($password);
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
    public static function checkPassword($hash, $password)
    {

    }
}
