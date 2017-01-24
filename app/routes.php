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
//QUESTION - wasn't sure whether to have a separate InteractionsController
//1 controller per resource (as per book) - thoughts?

//ANSWER (TOTO) - It is fine to use the same controller in this instance. You have to use pragmatism, otherwise you will
//have too many controllers