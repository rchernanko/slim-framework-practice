<?php

use BusuuTest\Controller\ExerciseController;
use Slim\Http\Request;
use Slim\Http\Response;


$app->get('/users/{userId}/exercises', function(Request $request, Response $response, $args) {

    global $mysqli;

    $query = "select * from exercises";
    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    if (isset($data)) {
        return $response->withJson($data);
    }

//    return $this->get(ExerciseController::class)->createExercise($request, $response, $args);
});

/**
 * Create here the voting endpoint
 */
