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
    public function __construct($urls)
    {
        $this->urls = $urls;
        $this->urls['assets'] = '/public/assets/';
        $this->urls['media'] = '/public/media/';
        $this->urls['gwf'] = 'http://fonts.googleapis.com/css?family=';
    }

    public function genImg($image, $size)
    {
        return $this->urls['media'] . $image['name'] . "_" . $size . "." . $image['extension'];
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
    public function gen($string)
    {
        return isset($this->urls[$string]) ? $this->urls[$string] : $string;
    }
}
