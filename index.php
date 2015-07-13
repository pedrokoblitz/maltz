<?php

use Maltz\Maltz;

require dirname(__FILE__).'/vendor/autoload.php';

$app = Maltz::initialize();
$app->run();
