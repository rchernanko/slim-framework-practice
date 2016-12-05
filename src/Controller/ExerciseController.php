<?php

namespace BusuuTest\Controller;

use BusuuTest\Entity\Exercise;
use BusuuTest\EntityRepository\ExerciseRepository;
use BusuuTest\EntityRepository\UserRepository;
use Slim\Http\Request;
use Slim\Http\Response;


class ExerciseController
{
    /** @var  ExerciseRepository */
    private $exerciseRepository;
    /** @var  UserRepository */
    private $userRepository;

    /**
     * ExerciseController constructor.
     * @param ExerciseRepository $exerciseRepository
     * @param UserRepository $userRepository
     */
    public function __construct(ExerciseRepository $exerciseRepository, UserRepository $userRepository)
    {
        $this->exerciseRepository = $exerciseRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Endpoint to create an exercise. An exercise contains text submitted by a user.
     */
    public function createExercise (Request $request, Response $response, $args) {
        $data = json_decode($request->getBody());
        $userId = $args['userId'];

        // Check parameter validity
        if (empty($data->text)) {
            return $response->withJson(['msg' => 'Text is missing!'], 400);
        }

        $userRepository = new UserRepository();
        $exerciseRepository = new ExerciseRepository();

        // Create exercise
        $exercise = new Exercise();
        $exercise->setText($data->text);
        $exercise->setAuthor($userRepository->find($userId));
        $exerciseRepository->save($exercise);

        // Return response
        return $response->withJson(['status' => 'ok']);
    }
}