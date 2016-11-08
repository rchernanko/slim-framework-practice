<?php
use BusuuTest\Entity\Exercise;
use BusuuTest\ExerciseRepository\ExerciseRepository;
use BusuuTest\ExerciseRepository\UserRepository;
use Slim\Http\Request;
use Slim\Http\Response;

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App();


/**
 * Endpoint to create an exercise. An exercise contains text submitted by a user.
 */
$app->post('/users/:userId/exercises', function (Request $request, Response $response, $args) {
    $data = json_decode($request->getBody());
    $userId = $args['userId'];

    // Check parameter validity
    if (empty($data->text)) {
        $response->withStatus(400);
        $response->getBody()->write(json_encode(['msg' => 'Text is missing!']));
        return $response;
     }

    $userRepository = new UserRepository();
    $exerciseRepository = new ExerciseRepository();

    // Create exercise
    $exercise = new Exercise();
    $exercise->setText($data->text);
    $exercise->setAuthor($userRepository->find($userId));
    $exerciseRepository->save($exercise);

    // Return response
    $response->withStatus(200);
    $response->getBody()->write(json_encode(['status' => 'ok']));
    return $response;
});



/**
 * Create here the voting endpoint
 */
