<?php

$app = new \Slim\Slim();

/**
* Endpoint to create an exercise. An exercise is just some text submitted by a user.
*/
$app->post('/users/:userId/exercises', function ($userId) use ($app) {
    $data = json_decode($app->request->getBody());

    if (empty($data->text)) {
        throw new HttpException(400, 'Text is missing!');
    }

    $exercise = new Exercise();
    $exercise->setText($data->text);
    $exercise->setAuthor($userId);

    $exerciseManager = new ExerciseManager();
    $exerciseManager->save($exercise);

	$app->response->setStatus(200);
	$app->response->setBody(json_encode(['status' => 'ok']));
});

/**
 * Create here the voting endpoint
 */




/**
* EXAMPLE OF WHAT IS EXPECTED FROM CANDIDATE -- NOT SHOWN TO CANDIDATE
*/
$app->post('/exercises/:exerciseId/votes', function ($exerciseId) use ($app) {
    $data = json_decode($app->request->getBody());

    // Validate post data
    if (empty($data->userId) || empty($data->value)) {
        throw new HttpException(400, 'User or value is missing!');
    }

    $votingUser = $data->userId;
    $voteValue = $data->value;

    $exerciseManager = new ExerciseManager();
    $exercise = $exerciseManager->find($exerciseId);

    // Validate that exercise exists and user is not voting for its own exercise
    if (is_null($exercise)) {
        throw new HttpException(404, 'Exercise not found');
    }
    if ($exercise->getAuthor() === $votingUser) {
        throw new HttpException(400, 'Cannot vote for own exercise');
    }

    // Find existing vote, as you can only vote once for an exercise
    $voteManager = new VoteManager();
    $vote = $voteManager->findByUserAndExercise($votingUser, $exerciseId);
    if (!$vote) {
        $vote = new Vote();
    }

    $vote->setValue($voteValue);
    $vote->setUser($votingUser);
    $vote->setExercise($exercise);

    $voteManager = new VoteManager();
    $voteManager->save($vote);

    $app->response->setStatus(200);
    $app->response->setBody(json_encode(['status' => 'ok']));
});
