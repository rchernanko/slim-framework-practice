<?php

use BusuuTest\Controller\ExerciseController;
use Slim\Http\Request;
use Slim\Http\Response;


$app->post('/users/{userId}/exercises', function(Request $request, Response $response, $args) {
    return $this->get(ExerciseController::class)->createExercise($request, $response, $args);
});

/**
 * Create here the voting endpoint
 */
