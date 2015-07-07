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


class Paginacao {

	/**
	* calcula numero das páginas
	*
	* @param int $num_pages 
	*
	* @param int $limit
	*
	* @param $page
	*
	* @return object
	*
	**/
	public static function paginar($num_pages, $limit, $page){

		/*** the number of pages ***/
		$num_pages = ceil((int)$num_pages / (int)$limit);
		$page = max($page, 1);
		$page = min($page, $num_pages);

		/*** calculate the offset ***/
		$offset = ($page - 1) * $limit;
		if ($offset < 0) {
			$offset = 0;
		}

		/*** a new instance of stdClass ***/
		$ret = new stdClass;

		/*** assign the variables to the return class object ***/
		$ret->offset   = (int)$offset;
		$ret->limit    = (int)$limit;
		$ret->num_pages = (int)$num_pages;
		$ret->page     = (int)$page;

		/*** return the object ***/
		return $ret;
	}

} /*** fin ***/


?>
