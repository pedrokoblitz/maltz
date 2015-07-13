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

class Pagination
{
    public static function paginate($page, $per_page)
    {
        $ret = new \stdClass;
        $ret->offset = ($page - 1) * $per_page;
        $ret->limit = $per_page;
        return $ret;
    }

    public static function pager($num_pages, $per_page, $page)
    {

        /*** the number of pages ***/
        $num_pages = ceil((int) $num_pages / (int) $limit);
        $page = max($page, 1);
        $page = min($page, $num_pages);

        /*** calculate the offset ***/
        $offset = ($page - 1) * $limit;
        if ($offset < 0) {
            $offset = 0;
        }

        /*** a new instance of stdClass ***/
        $ret = new \stdClass;

        /*** assign the variables to the return class object ***/
        $ret->offset = (int) $offset;
        $ret->limit = (int) $limit;
        $ret->num_pages = (int) $num_pages;
        $ret->page = (int) $page;

        /*** return the object ***/
        return $ret;
    }
} /*** fin ***/
