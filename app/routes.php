<?php

use BusuuTest\Controller\ExerciseController;
use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/exercises', function(Request $request, Response $response, $args) use ($app) {

    /*
     * Prior to me getting injecting the db connection as part of DIC container, I wrote:
     * global $mySqli
     *
     * Vito said that he will slap me if he ever sees the use of global in my php code...
     * Instead it's much better practice to use Dependency Injections and make things available globally that way
     */

    $container = $app->getContainer();
    $mysqli = $container['db'];

    $query = "select * from exercises";
    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    if (isset($data)) {
        return $response->withJson($data);
    }

    return 'yo';
//    return $this->get(ExerciseController::class)->createExercise($request, $response, $args);
});


//do a post

//do a delete

//do an update

//next step. start to build in mvc, using the controller etc
//then with ORM

/**
 * Create here the voting endpoint
 */
