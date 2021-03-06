<?php

use SlimPractice\Controller\ExerciseController;
use Slim\Http\Request;
use Slim\Http\Response;


/*
 * In the below, the $this (in the return) relates to the container I am 'using' in the below
 *
 * Also, prior to me adding my db connection to the dependency injection container, I wrote:
 *
 * global $mySqli
 *
 * Vito said that he will slap me if he ever sees the use of global in my php code...
 * Instead it's much better practice to use Dependency Injections and make things available globally that way
 */

$app->get('/exercises', function (Request $request, Response $response) use ($container) {
    return $this->get(ExerciseController::class)->getExercises($request, $response);
});

$app->get('/exercises/{id}', function (Request $request, Response $response) use ($container) {
    return $this->get(ExerciseController::class)->getExercise($request, $response);
});

$app->delete('/exercises/{id}', function (Request $request, Response $response) use ($container) {
    return $this->get(ExerciseController::class)->deleteExercise($request, $response);
});

$app->post('/exercises', function (Request $request, Response $response) use ($container) {
    return $this->get(ExerciseController::class)->saveExercise($request, $response);
});

$app->put('/exercises/{id}', function (Request $request, Response $response) use ($container) {
    return $this->get(ExerciseController::class)->updateExercise($request, $response);
});

/**
 * Create here the voting endpoint
 */
