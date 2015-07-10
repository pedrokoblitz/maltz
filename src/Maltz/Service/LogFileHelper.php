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

class LogFileHelper
{

    private $file;

    /*
	 * construtor
	 *
	 * @param $file string
	 *
	 * return void
	 *
	 */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /*
	 * logar msg no file
	 *
	 * @param $msg string
	 *
	 * return void
	 *
	 */
    public function log($msg)
    {
        $fh = fopen($this->file, 'a');
        fwrite($fh, $msg . "\n");
        fclose($fh);
    }
}
