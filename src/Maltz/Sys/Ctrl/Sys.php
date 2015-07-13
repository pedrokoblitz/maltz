<?php

namespace Maltz\Sys\Ctrl;

use Maltz\Sys\Model\Panel;
use Maltz\Sys\Model\User;
use Maltz\Utils\Porteiro;
use Maltz\Mvc\Controller;
use Maltz\Mvc\View;

/**
 * Ações da administraction do sistema
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

class Sys extends Controller
{

    public function route($app)
    {
        return $app;
    }
}
