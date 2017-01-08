<?php


use BusuuTest\EntityRepository\ExerciseRepository;
use BusuuTest\EntityRepository\UserRepository;
use BusuuTest\Controller\ExerciseController;
use BusuuTest\Entity\Exercise;
use BusuuTest\Entity\Vote;

$container = $app->getContainer();

$container[ExerciseRepository::class] = function () {
    return new ExerciseRepository();
};

$container[UserRepository::class] = function () {
    return new UserRepository();
};

$container[ExerciseController::class] = function () use ($container) {
    return new ExerciseController(
        $container[ExerciseRepository::class],
        $container[UserRepository::class]
    );
};

//TODO not sure exactly if this is correct - talk it through...
$container[Vote::class] = function () {
    return new Vote();
};

//TODO not sure exactly if this is correct - talk it through...
$container[Exercise::class] = function () use ($container) {
    return new Exercise(
        $container[Vote::class]
    );
};