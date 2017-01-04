<?php

use BusuuTest\Controller\ExerciseController;
use Slim\Http\Request;
use Slim\Http\Response;


$app->post('/users/{userId}/exercises', function(Request $request, Response $response, $args) {
    return $this->get(ExerciseController::class)->createExercise($request, $response, $args);
});

$app->post('/interactions/{exerciseId}/votes', function(Request $request, Response $response, $args) {
    return $this->get(ExerciseController::class)->submitVote($request, $response, $args);
});