<?php


use BusuuTest\EntityRepository\ExerciseRepository;
use BusuuTest\EntityRepository\UserRepository;
use BusuuTest\Controller\ExerciseController;

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

$container[ExerciseRepository::class] = function() {
    return new ExerciseRepository();
};

$container[UserRepository::class] = function() {
    return new UserRepository();
};

$container[ExerciseController::class] = function() use ($container) {
    return new ExerciseController(
        $container[ExerciseRepository::class],
        $container[UserRepository::class]
    );
};