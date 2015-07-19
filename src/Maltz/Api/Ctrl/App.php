<?php

namespace Maltz\Api\Ctrl;

use Maltz\Mvc\View;

class App
{

    public static function route($app)
    {

        $app->view->setLayout('backend.tpl.php');

        $app->get('/backend/:controller', function ($controller) use ($app) {
            $vars = array(
            );

            $app->render($controller, $vars);
        });

        return $app;
    }
}
