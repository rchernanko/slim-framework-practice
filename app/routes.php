<?php

use BusuuTest\Controller\ExerciseController;
use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/exercises', function (Request $request, Response $response) use ($container) {
    return $this->get(ExerciseController::class)->getExercises($request, $response, $container);
    //TODO having to pass the container down into the controller / repository / entity cannot be right...

    /*
     * In the above, the $this relates to the container I am using in the above
     *
     * Also, prior to me adding my db connection to the dependency injection container, I wrote:
     *
     * global $mySqli
     *
     * Vito said that he will slap me if he ever sees the use of global in my php code...
     * Instead it's much better practice to use Dependency Injections and make things available globally that way
     */

});

$app->get('/exercises/{id}', function (Request $request, Response $response) use ($container) {
    return $this->get(ExerciseController::class)->getExercise($request, $response, $container);
});

$app->delete('/exercises/{id}', function (Request $request, Response $response) use ($container) {
    return $this->get(ExerciseController::class)->deleteExercise($request, $response, $container);
});

$app->post('/exercises', function (Request $request, Response $response) use ($container) {
    return $this->get(ExerciseController::class)->saveExercise($request, $response, $container);
});

$app->put('/exercises/{id}', function (Request $request, Response $response) use ($container) {
    return $this->get(ExerciseController::class)->updateExercise($request, $response, $container);
});

/**
 * Create here the voting endpoint
 */
