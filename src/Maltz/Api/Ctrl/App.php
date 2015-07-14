<?php

namespace Maltz\Api\Ctrl;

use Maltz\Mvc\View;

class App {

    public static function route($app) {

        $app->get('/app/:model/:type/', function ($model, $type) use ($app) {
        	$vars = array(
        		'model' => $model,
        		'type' => $type
    		);
        	$app->render($model . '.' . $type . '.tpl.php', $vars);
    	});

    	return $app;
 	}     
}