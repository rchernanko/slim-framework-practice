<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use SlimPractice\Controller\ExerciseController;
use SlimPractice\EntityRepository\ExerciseRepository;
use SlimPractice\EntityRepository\UserRepository;
use SlimPractice\Support\DbCommands;

$container = $app->getContainer();

//Add my db connection to the dependency container
$container['db'] = function ($container) use ($config) { //TODO get to grips with what the use is doing here... http://php.net/manual/en/functions.anonymous.php#example-160
    return new mysqli($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['db_name']);
};

//Add a logger
$container['logger'] = function() {
    $logger = new Logger('my_logger');
    $file_handler = new StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

//Now let's add the 3 classes I need as part of the MVC pattern:

//ExerciseController, ExerciseRepository and UserRepository

/*

NOTE the below will also work for exerciseRepository

$container['exerciseRepository'] = function () {
    return new ExerciseRepository();
};

*/

$container[DbCommands::class] = function ($container) {
    return new DbCommands($container);
};

$container[ExerciseRepository::class] = function ($container) {
    return new ExerciseRepository($container);
};

$container[UserRepository::class] = function ($container) {
    return new UserRepository($container);
};

$container[ExerciseController::class] = function () use ($container) {
    return new ExerciseController(
        $container[ExerciseRepository::class],
        $container[UserRepository::class]
    );
};