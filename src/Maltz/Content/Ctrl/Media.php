<?php

namespace Maltz\Media\Ctrl;

use Maltz\Media\Model\Resource;
use Maltz\Media\Model\Collection;
use Maltz\Content\Model\Page;
use Maltz\Content\Model\Content;
use Maltz\Content\Model\Book;
use Maltz\Mvc\Controller;
use Maltz\Mvc\View;
use Maltz\Utils\Upload;

/**
 * Ações dos dbs de mídia
 *
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

class Media extends Controller
{

    public function route($app)
    {
        return $app;
    }
}
