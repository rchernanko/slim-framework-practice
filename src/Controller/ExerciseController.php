<?php

namespace BusuuTest\Controller;

use BusuuTest\Entity\Exercise;
use BusuuTest\EntityRepository\ExerciseRepository;
use BusuuTest\EntityRepository\UserRepository;
use Slim\Container;
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
     * Endpoint to get all exercises
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getExercises(Request $request, Response $response)
    {
        $data = $this->exerciseRepository->findAll();

        if (isset($data)) {
            return $response->withJson($data, 200);
        }

        return $response->withJson(['msg' => 'No exercises found'], 404);
    }

    /**
     * Endpoint to get a specific exercise
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getExercise(Request $request, Response $response)
    {
        $exerciseId = $request->getAttribute('id');
        $data = $this->exerciseRepository->find($exerciseId);

        if (isset($data)) {
            return $response->withJson($data, 200);
        }

        return $response->withJson(['msg' => 'No exercises found'], 404);
        //TODO in my response make sure i always set application/json
    }

    /**
     * Endpoint to delete an exercise
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function deleteExercise(Request $request, Response $response)
    {
        $exerciseId = $request->getAttribute('id');
        $this->exerciseRepository->delete($exerciseId);

        return $response->withJson("Exercise with id $exerciseId has been deleted", 200);
    }

    /**
     * Endpoint to save a new exercise
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function saveExercise(Request $request, Response $response)
    {
        $this->exerciseRepository->save($request);

        return $response->withJson("Exercise has been created", 200);
    }

    /**
     * Endpoint to update an existing exercise
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function updateExercise(Request $request, Response $response)
    {
        $exerciseId = $request->getAttribute('id');

        $this->exerciseRepository->update($exerciseId, $request);

        return $response->withJson("Exercise text within $exerciseId has been updated", 200);
    }







    //TODO i think the below starts to build on ORM...come back to this as I should be using this instead of the above...
    /**
     * Endpoint to create an exercise. An exercise contains text submitted by a user.
     */
//    public function createExercise(Request $request, Response $response, $args)
//    {
//        $data = json_decode($request->getBody());
//        $userId = $args['userId'];
//
//        // Check parameter validity
//        if (empty($data->text)) {
//            return $response->withJson(['msg' => 'Text is missing!'], 400);
//        }
//
//        $userRepository = new UserRepository();
//        $exerciseRepository = new ExerciseRepository();
//
//        // Create exercise
//        $exercise = new Exercise();
//        $exercise->setText($data->text);
//        $exercise->setAuthor($userRepository->find($userId));
//        $exerciseRepository->save($exercise);
//
//        // Return response
//        return $response->withJson(['status' => 'ok']);
//    }
}