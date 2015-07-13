<?php

namespace Maltz\Content\Ctrl;

use Maltz\Content\Model\Block;
use Maltz\Content\Model\Cover;
use Maltz\Content\Model\Page;
use Maltz\Content\Model\Content;
use Maltz\Content\Model\Book;
use Maltz\Mvc\Controller;
use Maltz\Mvc\View;
use Maltz\Sys\Model\Rss;
use Maltz\Utils\Carteiro;

/**
 * Ações do frontend
 *
 * http://ideiasinsolitas.com.br/
 *
 * @copyright  Copyright (c) 2012-2013 Pedro Koblitz
 * @author     Pedro Koblitz pedrokoblitz@gmail.com
 * @license    GPL v2
 *
 * @package    Meu CMS ainda não tem name
 *
 * @version    0.1 alpha
 */

class Site extends Controller
{

    public function route($app)
    {
        return $app;
    }
}
