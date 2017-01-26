<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App();

require_once __DIR__ . '/../app/config.php';
require_once __DIR__ . '/../app/dependencies.php';
require_once __DIR__ . '/../app/routes.php';

$app->run();
