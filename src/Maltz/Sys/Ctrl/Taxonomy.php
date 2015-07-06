<?php

namespace Maltz\Sys\Ctrl;

use Maltz\Mvc\Controller;
use Maltz\Sys\Model\Term;
use Maltz\Sys\Model\TermType;

class Taxonomy extends Controller
{
    public function route($app)
    {
        $app->get('', function () {
            
        })->name('')->conditions(array('' => '',));

        return $app;
    }
}
