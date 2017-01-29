<?php

use Slim\App;
use Slim\Container;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();
$app = new App($container);

require_once __DIR__ . '/../app/config.php';
require_once __DIR__ . '/../app/dependencies.php';
require_once __DIR__ . '/../app/routes.php';

$app->run();
