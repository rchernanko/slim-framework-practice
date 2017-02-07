<?php


use BusuuTest\EntityRepository\ExerciseRepository;
use BusuuTest\EntityRepository\UserRepository;
use BusuuTest\Controller\ExerciseController;
use BusuuTest\Support\DbCommands;

$container = $app->getContainer();

//Add my db connection to the dependency container
$container['db'] = function ($container) {
    $config = $container['config']['db'];
    return new mysqli($config['host'], $config['user'], $config['pass'], $config['db_name']);
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

$container[ExerciseController::class] = function () use ($container) { //TODO get to grips with what the use is doing here...
    return new ExerciseController(
        $container[ExerciseRepository::class],
        $container[UserRepository::class]
    );
};