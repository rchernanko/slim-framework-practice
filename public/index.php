<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App();
//Is this correct for the DI though?
//$app = new \Slim\App($container);

require_once __DIR__ . '/../app/dependencies.php';
require_once __DIR__ . '/../app/routes.php';

$app->run();