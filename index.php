<?php

use Maltz\Application;

require dirname(__FILE__).'/vendor/autoload.php';

$app = Application::initialize();
$app->run();
