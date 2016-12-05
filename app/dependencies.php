<?php


use BusuuTest\EntityRepository\ExerciseRepository;
use BusuuTest\EntityRepository\UserRepository;
use BusuuTest\Controller\ExerciseController;

$container = $app->getContainer();

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