<?php

namespace Maltz\Api\Ctrl;

use Maltz\Mvc\View;

class App
{

    public static function route($app)
    {

        $app->view->setLayout('backend');

        $app->get('/backend/:controller', function ($controller) use ($app) {
            $app->render($controller, $vars);
        });

        return $app;
    }
}
