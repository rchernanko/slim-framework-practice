<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App();

require_once __DIR__ . '/../app/dependencies.php';
require_once __DIR__ . '/../app/routes.php';
require_once __DIR__ . '/../database/dbConnect.php';

$app->run();
