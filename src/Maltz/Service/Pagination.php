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

    protected $offset;
    protected $limit;
    protected $num_pages;
    protected $page;

    public function __get($key)
    {
        if (in_array($key, array('offset', 'limit', 'num_pages', 'page'))) {
            return $this->$key;
        }
    }

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
    public function paginate($num_pages, $limit, $page)
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

        /*** assign the variables to the return class object ***/
        $this->offset = (int) $offset;
        $this->limit = (int) $limit;
        $this->num_pages = (int) $num_pages;
        $this->page = (int) $page;

        return $this;
    }
} /*** fin ***/
